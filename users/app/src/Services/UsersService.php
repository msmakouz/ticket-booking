<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Role;
use App\Entity\User;
use App\Exception\PasswordIncorrectException;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepositoryInterface;
use App\Security\PasswordHasher;
use App\Services\Mappers\TimestampFactory;
use App\Services\Mappers\UserFactory;
use App\Specification\PasswordIsSecureSpecification;
use App\Specification\UniqueEmailSpecification;
use App\ValueObject\Email;
use Carbon\Carbon;
use Cycle\ORM\EntityManagerInterface;
use Google\Protobuf\Timestamp;
use Spiral\RoadRunner\GRPC;
use Spiral\RoadRunner\Metrics\MetricsInterface;
use Spiral\Shared\Services\Tokens\v1\DTO\CreateRequest;
use Spiral\Shared\Services\Tokens\v1\TokensServiceInterface;
use Spiral\Shared\Services\Users\v1\UsersServiceInterface;
use Spiral\Shared\Services\Users\v1\DTO;

class UsersService implements UsersServiceInterface
{
    public function __construct(
        private readonly TokensServiceInterface $tokensService,
        private readonly UserRepositoryInterface $userRepository,
        private readonly PasswordHasher $hasher,
        private readonly EntityManagerInterface $entityManager,
        private readonly UniqueEmailSpecification $uniqueEmailSpecification,
        private readonly PasswordIsSecureSpecification $passwordIsSecureSpecification,
        private readonly MetricsInterface $metrics
    ) {
    }

    public function Auth(
        GRPC\ContextInterface $ctx,
        DTO\AuthRequest $in
    ): DTO\AuthResponse {
        $user = $this->userRepository->findOneByEmail(new Email($in->getEmail()));

        if ($user === null) {
            throw new UserNotFoundException('User with this Email not found.');
        }

        if (!$this->hasher->isPasswordValid($in->getPassword(), $user->getPassword())) {
            throw new PasswordIncorrectException('The password is not valid. Check the password and try again.');
        }

        $response = $this->tokensService->Create(
            $ctx,
            new CreateRequest([
                'payload' => \json_encode(['userID' => $user->getId()]),
                'expires_at' => TimestampFactory::fromDateTimeInterface(Carbon::now()->addWeek()),
            ])
        );

        return new DTO\AuthResponse([
            'user' => UserFactory::fromUserEntity($user),
            'token' => $response->getToken(),
        ]);
    }

    public function Register(
        GRPC\ContextInterface $ctx,
        DTO\RegisterRequest $in
    ): DTO\RegisterResponse {
        $this->passwordIsSecureSpecification->isSecure($in->getPassword());
        $this->uniqueEmailSpecification->isUnique($email = new Email($in->getEmail()));

        $this->entityManager->persist(
            $user = new User(
                $email,
                $this->hasher->hash($in->getPassword()),
                [Role::USER->value]
            )
        );

        $this->entityManager->run();

        $this->metrics->add('total_users', 1);

        return new DTO\RegisterResponse([
            'user' => UserFactory::fromUserEntity($user),
        ]);
    }

    public function Get(
        GRPC\ContextInterface $ctx,
        DTO\GetRequest $in
    ): DTO\GetResponse {
        $data = [];

        $user = $this->userRepository->findByPK($in->getId());
        if ($user) {
            $data['user'] = UserFactory::fromUserEntity($user);
        }

        return new DTO\GetResponse($data);
    }
}

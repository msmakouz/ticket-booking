<?php

declare(strict_types=1);

namespace Spiral\Shared\Bootloader;

use Psr\Container\ContainerInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Spiral\Broadcasting\Bootloader\BroadcastingBootloader;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Core\Container;
use Spiral\Core\InterceptableCore;
use Spiral\RoadRunner\GRPC\InvokerInterface;
use Spiral\Shared\Config\GRPCServicesConfig;
use Spiral\Shared\GRPC\Interceptors\InjectTelemetryIntoContextInterceptor;
use Spiral\Shared\GRPC\Interceptors\ValidateRequestResponseInterceptor;
use Spiral\Shared\GRPC\Invoker;
use Spiral\Shared\GRPC\InvokerCore;
use Spiral\Shared\GRPC\ServiceClientCore;
use Spiral\Shared\Services\Cinema\v1\CinemaServiceClient;
use Spiral\Shared\Services\Cinema\v1\CinemaServiceInterface;
use Spiral\Shared\Services\Payment\v1\PaymentServiceClient;
use Spiral\Shared\Services\Payment\v1\PaymentServiceInterface;
use Spiral\Shared\Services\Tokens\v1\TokensServiceClient;
use Spiral\Shared\Services\Tokens\v1\TokensServiceInterface;
use Spiral\Shared\Services\Users\v1\UsersServiceClient;
use Spiral\Shared\Services\Users\v1\UsersServiceInterface;
use Spiral\Telemetry\TracerInterface;

class SharedBootloader extends Bootloader
{
	protected const DEPENDENCIES = [
	    BroadcastingBootloader::class,
	];

	public function __construct(private readonly ConfiguratorInterface $config)
	{
	}

	public function init(EnvironmentInterface $env): void
	{
		$this->initConfig($env);
	}

	public function boot(Container $container): void
	{
		$container->bindSingleton(
		    InvokerInterface::class,
		    static function (TracerInterface $tracer) use ($container): InvokerInterface {
		        return new Invoker(
		            $container, new InterceptableCore(
		                new InvokerCore(new \Spiral\RoadRunner\GRPC\Invoker(), $tracer),
		            )
		        );
		    }
		);

		$this->initServices($container);
	}

	/**
	 * Don't edit this method manually, it is generated by GRPC services generator.
	 */
	private function initConfig(EnvironmentInterface $env)
	{
		$this->config->setDefaults(
		    GRPCServicesConfig::CONFIG,
		    [
		        'services' => [
		            PaymentServiceClient::class => ['host' => $env->get('PAYMENTSERVICE_HOST', '127.0.0.1:9000')],
					CinemaServiceClient::class => ['host' => $env->get('CINEMASERVICE_HOST', '127.0.0.1:9001')],
					UsersServiceClient::class => ['host' => $env->get('USERSSERVICE_HOST', '127.0.0.1:9002')],
					TokensServiceClient::class => ['host' => $env->get('TOKENSSERVICE_HOST', '127.0.0.1:9003')],
		        ],
		    ]
		);
	}

	/**
	 * Don't edit this method manually, it is generated by GRPC services generator.
	 */
	private function initServices(Container $container): void
	{
		$credentials = \Grpc\ChannelCredentials::createInsecure();

		$container->bindSingleton(
		    PaymentServiceInterface::class,
		    static function (
		        GRPCServicesConfig $config,
		        ContainerInterface $container,
		    ) use ($credentials): PaymentServiceInterface {
		        $core = new InterceptableCore(
		            new ServiceClientCore(
		                $config->getService(PaymentServiceClient::class)['host'],
		                ['credentials' => $credentials]
		            )
		        );

		        $core->addInterceptor($container->get(InjectTelemetryIntoContextInterceptor::class));
		        $core->addInterceptor($container->get(ValidateRequestResponseInterceptor::class));

		        return new PaymentServiceClient($core);
		    }
		);

		$container->bindSingleton(
		    CinemaServiceInterface::class,
		    static function (
		        GRPCServicesConfig $config,
		        ContainerInterface $container,
		    ) use ($credentials): CinemaServiceInterface {
		        $core = new InterceptableCore(
		            new ServiceClientCore(
		                $config->getService(CinemaServiceClient::class)['host'],
		                ['credentials' => $credentials]
		            )
		        );

		        $core->addInterceptor($container->get(InjectTelemetryIntoContextInterceptor::class));
		        $core->addInterceptor($container->get(ValidateRequestResponseInterceptor::class));

		        return new CinemaServiceClient($core);
		    }
		);

		$container->bindSingleton(
		    UsersServiceInterface::class,
		    static function (
		        GRPCServicesConfig $config,
		        ContainerInterface $container,
		    ) use ($credentials): UsersServiceInterface {
		        $core = new InterceptableCore(
		            new ServiceClientCore(
		                $config->getService(UsersServiceClient::class)['host'],
		                ['credentials' => $credentials]
		            )
		        );

		        $core->addInterceptor($container->get(InjectTelemetryIntoContextInterceptor::class));
		        $core->addInterceptor($container->get(ValidateRequestResponseInterceptor::class));

		        return new UsersServiceClient($core);
		    }
		);

		$container->bindSingleton(
		    TokensServiceInterface::class,
		    static function (
		        GRPCServicesConfig $config,
		        ContainerInterface $container,
		    ) use ($credentials): TokensServiceInterface {
		        $core = new InterceptableCore(
		            new ServiceClientCore(
		                $config->getService(TokensServiceClient::class)['host'],
		                ['credentials' => $credentials]
		            )
		        );

		        $core->addInterceptor($container->get(InjectTelemetryIntoContextInterceptor::class));
		        $core->addInterceptor($container->get(ValidateRequestResponseInterceptor::class));

		        return new TokensServiceClient($core);
		    }
		);
	}
}

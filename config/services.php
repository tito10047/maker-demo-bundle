<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Tito10047\MakerDemoBundle\Command\HelloCommand;
use Tito10047\MakerDemoBundle\Controller\HelloController;
use Tito10047\MakerDemoBundle\EventListener\GreetingHeaderListener;
use Tito10047\MakerDemoBundle\Greeter;
use Tito10047\MakerDemoBundle\GreeterInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

/*
 * Services are defined explicitly: no autowiring, no autoconfiguration, private by default,
 * with ids prefixed by "tito10047_maker_demo." and aliases for autowiring.
 *
 * See https://symfony.com/doc/current/bundles/best_practices.html#services
 */
return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set('tito10047_maker_demo.greeter', Greeter::class)

        ->set('tito10047_maker_demo.controller.hello', HelloController::class)
            ->args([
                service('tito10047_maker_demo.greeter'),
                service('twig'),
            ])
            ->tag('controller.service_arguments')

        ->set('tito10047_maker_demo.command.hello', HelloCommand::class)
            ->args([
                service('tito10047_maker_demo.greeter'),
            ])
            ->tag('console.command')

        ->set('tito10047_maker_demo.event_listener.greeting_header', GreetingHeaderListener::class)
            ->args([
                service('tito10047_maker_demo.greeter'),
            ])
            ->tag('kernel.event_listener', ['event' => 'kernel.response'])

        ->alias(GreeterInterface::class, 'tito10047_maker_demo.greeter')
    ;
};

<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

/*
 * Import these routes in the application with:
 *
 *     $routes->import('@Tito10047MakerDemoBundle/config/routes.php');
 *
 * See https://symfony.com/doc/current/bundles/best_practices.html#routing
 */
return static function (RoutingConfigurator $routes): void {
    $routes->add('tito10047_maker_demo_hello', '/hello/{name}')
        ->controller('tito10047_maker_demo.controller.hello')
        ->methods(['GET'])
        ->defaults(['name' => 'World'])
    ;
};

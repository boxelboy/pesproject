<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($container) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($container) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write("This isn't the page you are looking for");
    };
};

$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
        'cache' => false,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $container['UserController'] = function ($container) {
        return new App\Controllers\UserController($container);
    };

    $view->getEnvironment()->addGlobal('UserController', [
        'check' => $container->UserController->check(),
        'user' => $container->UserController->user(),
    ]);

    return $view;
};



$container['IndexController'] = function ($container) {
    return new App\Controllers\IndexController($container);
};

$container['RoleController'] = function ($container) {
    return new App\Controllers\RoleController($container);
};

$container['OrganisationController'] = function ($container) {
    return new App\Controllers\OrganisationController($container);
};

$container['WelcomeController'] = function ($container) {
    return new App\Controllers\WelcomeController($container);
};

$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};
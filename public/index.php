<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Dotenv\Dotenv;

require '../vendor/autoload.php';
require '../src/helpers.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$app = AppFactory::create();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$routeDefinitions = require '../src/routes.php';
$routeDefinitions($app);

$app->run();

?>

<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../src/helpers.php';

$app = AppFactory::create();
// $app->get('/ss', function (Request $request, Response $response, array $args){
//     $response->getBody()->write('Hello, worlsod!');
//     return $response;
// });
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$routeDefinitions = require '../src/routes.php';
$routeDefinitions($app);

// Run the app
$app->run();


// $app->get('/s', function (Request $request, Response $response) {
//     $response->getBody()->write('Hello, world!');
//     return $response;
// });
// // Add routing middleware
// $app->addRoutingMiddleware();

// // Add error handling middleware
// $errorMiddleware = $app->addErrorMiddleware(true, true, true);

// // Include the routes
// require '../src/routes.php';

// Run the app
// $app->run();
?>

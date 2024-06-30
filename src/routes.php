<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\ApiController;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello, WEB!');
        return $response;
    });
    $app->group('/api', function (RouteCollectorProxy $group){
        $group->get('/', function (Request $request, Response $response) {
            $response->getBody()->write('Hello, API!');
            return $response;
        });
        $group->get('/hello', [ApiController::class, 'index']);
        $group->get('/hello-old', function (Request $request, Response $response, $args) {
            $params = $request->getQueryParams();
            dd($params); exit;
            $visitor_name = $params['visitor_name'] ?? 'Guest';

            // Get the visitor's IP address
            $client_ip = $_SERVER['REMOTE_ADDR'];


            

            // Get the location data for the IP address
            try {
                $record = ''; //$reader->city($client_ip);
                $location = ''; //$record->city->name . ', ' . $record->country->name;
            } catch (Exception $e) {
                // If the lookup fails, default to 'Unknown'
                $location = 'Unknown';
            }

            // Create the response array
            $data = [
                "client_ip" => $client_ip,
                "location" => $location,
                "greeting" => "Hello, $visitor_name!"
            ];

            // Set the content type to JSON and write the response
            $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-Type', 'application/json');
        });
    });
};
?>

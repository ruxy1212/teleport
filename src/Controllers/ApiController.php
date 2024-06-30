<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController
{
    public function index(Request $request, Response $response, $args): Response {
        $params = $request->getQueryParams();
        if(isset($params['visitor_name'])) {
            $client_ip = $_SERVER['REMOTE_ADDR'];
            $ip_details = json_decode(file_get_contents("http://ipinfo.io/{$client_ip}/json"));
            if(property_exists($ip_details, 'city') && property_exists($ip_details, 'country') && !property_exists($ip_details, 'bogon')){
                $location = $ip_details->city . ', ' . $ip_details->country;
            }else{
                $location = 'Unknown';
            }
            $data = [
                "client_ip" => $client_ip,
                "location" => $location,
                "greeting" => "Hello, ".$params['visitor_name']."!"
            ];
        }else{
            //return invalid parameter error
            $data = [
                "error" => "Invalid parameter given. Please provide 'visitor_name' argument."
            ];
        }
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
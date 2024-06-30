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
            if(property_exists($ip_details, 'city') && property_exists($ip_details, 'loc') && !property_exists($ip_details, 'bogon')){ // && property_exists($ip_details, 'country')
                $location = $ip_details->city; // . ', ' . $ip_details->country;
                $geo_location = explode(',', $ip_details->loc);
                $api_key = '02c52a0fa6d8653d1da3d65a06213177';
                $weather_details = json_decode(file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat={$geo_location[0]}&lon={$geo_location[1]}&appid={$api_key}&units=metric"));
                if(property_exists($weather_details, 'main')){
                    $temp_main = $weather_details->main;
                    if(property_exists($temp_main, 'temp')) $temperature = ceil($temp_main->temp);
                    else $temperature = 'Unknown';
                }else $temperature = 'Unknown';
            }else{
                $location = 'Unknown';
                $temperature = 'Unknown';
            }
            $data = [
                "client_ip" => $client_ip,
                "location" => $location,
                "greeting" => "Hello, ".$params['visitor_name']."!, the temperature is ".$temperature." degrees Celsius in ".$location,
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
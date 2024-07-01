<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController
{
    public function index(Request $request, Response $response, $args): Response {
        $params = $request->getQueryParams();
        if(isset($params['visitor_name'])){
            $visitor_name = $params['visitor_name']==''?'Nameless':$params['visitor_name'];
            $client_ip = $_SERVER['REMOTE_ADDR'];
            $api_key = $_ENV['WEATHER_KEY'];
            $weather_details = json_decode(file_get_contents("http://api.weatherapi.com/v1/current.json?key={$api_key}&q={$client_ip}&aqi=no"));
            if(property_exists($weather_details, 'location') && property_exists($weather_details, 'current')){
                $current_weather = $weather_details->current;
                $location = $weather_details->location;
                $temperature = (property_exists($current_weather, 'temp_c')) ? ceil($current_weather->temp_c) : 'Unknown';
                $city = (property_exists($location, 'name')) ? $location->name : 'Unknown';
            }else{
                $city = 'Unknown';
                $temperature = 'Unknown';
            }
            $data = [
                "client_ip" => $client_ip,
                "location" => $city,
                "greeting" => "Hello, ".$visitor_name."!, the temperature is ".$temperature." degrees Celsius in ".$city,
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

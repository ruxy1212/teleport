# Simple Web Server API - HNG Stage 1
This application is a simple web server with an API endpoint that takes a visitor's name argument, and then returns a JSON containing the visitor's name, the request's IP address, city name and temperature of the IP address.

This app is based on Slim PHP Framework and uses 1 external API; [Weather API (JSON)](https://api.weatherapi.com/v1/) for getting weather information like temperature and geolocation details like city, region, country, timezone, temperature, humidity, etc.

[App Hosted Here](https://teleport-hng.000webhostapp.com)

## To Test API
Request: [GET]
API Endpoint: `api/hello`
Request Param: `visitor_name`
URL Example: `https://teleport-hng.000webhostapp.com/api/hello?visitor_name=Ruxy`

## To Test Locally
- Clone the repository.
- Navigate to the project directory.
- Install dependencies using `composer install` command.
- Generate .env file by running `cp .env.example .env` and set your Weather API key ([Create an account](https://weatherapi.com/login) to generate your key)
- Start the Application using PHP Built-in server `php -S localhost:8888 -t public public/index.php`.
- Access the task api endpoint at `api/hello`.

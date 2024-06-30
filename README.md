﻿# Simple Web Server API - HNG Stage 1
This application is a simple web server with an API endpoint that takes a name argument, and returns a JSON containing the visitor's name, the request's IP address, city name and temperature of the IP address.

[Hosted Here](https://teleport-hng.000webhostapp.com)

Request: [GET]
API Endpoint: `api/hello`
Request Param: `visitor_name`
URL Example: `https://teleport-hng.000webhostapp.com/api/hello?visitor_name=Ruxy`

## To Test Locally
- Clone the repository.
- Navigate to the project directory using CLI.
- Install dependencies using `composer install` command.
- Start the Application using PHP Built-in server `php -S localhost:8888 -t public public/index.php`.
- Access the task api endpoint at `api/hello`.

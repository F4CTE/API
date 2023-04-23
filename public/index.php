<?php

use App\Controller\GenericController;

require_once __DIR__ . '/../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


$uri = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];



$response = (new GenericController())->handleRequest($uri, $httpMethod);

http_response_code($response['http_code']);
unset($response['http_code']);
header('Content-Type: application/json');
echo json_encode($response);
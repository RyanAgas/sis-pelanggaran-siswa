<?php

$method = $_SERVER['REQUEST_METHOD'];

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = $_SERVER['SCRIPT_NAME'];

$uri = substr($requestUri, strlen($scriptName));
$uri = $uri === '' ? '/' : $uri;

//test api
if ($method === 'GET' && $uri === '/ping') {
    echo json_encode([
        "status" => "OK",
        "message" => "API modulmu sudah berjalan"
    ]);
    exit;

//end point tidak ketemu
http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "endpoint tidak ditemukan"
]);
exit;
}
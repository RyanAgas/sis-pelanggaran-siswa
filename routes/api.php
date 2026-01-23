<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/PelanggaranController.php';
require_once __DIR__ . '/../controllers/PembinaanController.php';

$method = $_SERVER['REQUEST_METHOD'];

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = $_SERVER['SCRIPT_NAME'];

$uri = substr($requestUri, strlen($scriptName));
$uri = $uri === '' ? '/' : $uri;

//login
if ($method === 'POST' && $uri === '/login') {
    $controller = new AuthController();
    $controller->login();
    exit;
} 

//log out
if ($method === 'POST' && $uri === '/logout') {
    requireLogin(); // pastikan sudah login
    logout();
    exit;
}

//pelanggaran
if ($method === 'GET' && $uri === '/pelanggaran') {
    $controller = new PelanggaranController();
    $controller->index();
    exit;
}

if ($method === 'POST' && $uri === '/pelanggaran') {
    $controller = new PelanggaranController();
    $controller->store();
    exit;
}

// Update Pelanggaran
if ($method === 'PUT' && preg_match('#^/pelanggaran/(\d+)$#', $uri, $matches)) {
    $controller = new PelanggaranController();
    $controller->update($matches[1]);
    exit;
}

// Delete pelanggaran
if ($method === 'DELETE' && preg_match('#^/pelanggaran/(\d+)$#', $uri, $matches)) {
    $controller = new PelanggaranController();
    $controller->destroy($matches[1]);
    exit;
}

//pembinaan
if ($method == 'GET' && $uri === '/pembinaan') {
    $controller = new PembinaanController();
    $controller->index();
    exit;
}

if ($method === 'POST' && $uri === '/pembinaan') {
    $controller = new PembinaanController();
    $controller->store();
    exit;
}

//update pembinaan
if ($method === 'PUT' && preg_match('#^/pembinaan/(\d+)$#', $uri, $matches)) {
    $controller = new PembinaanController();
    $controller->update($matches[1]);
    exit;
}

//DELETE Pembinaan
if ($method == 'DELETE' && preg_match('#^/pembinaan/(\d+)$#', $uri, $matches)) {
    $controller = new PembinaanController();
    $controller->destroy($matches[1]);
}

//test api
if ($method === 'GET' && $uri === '/ping') {
    echo json_encode([
        "status" => "OK",
        "message" => "API modul sudah berjalan"
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
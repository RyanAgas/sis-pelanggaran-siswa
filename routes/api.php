<?php

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/PelanggaranController.php';
require_once __DIR__ . '/../controllers/PembinaanController.php';
require_once __DIR__ . '/../controllers/LaporanController.php';
require_once __DIR__ . '/../controllers/SiswaController.php';
require_once __DIR__ . '/../controllers/UserController.php';


$method = $_SERVER['REQUEST_METHOD'];

// Ambil URI yang bersih
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = $_SERVER['SCRIPT_NAME'];

$uri = substr($requestUri, strlen($scriptName));
$uri = $uri === '' ? '/' : rtrim($uri, '/');

// auth

if ($method === 'POST' && $uri === '/login') {
    $controller = new AuthController();
    $controller->login();
    exit;
}

if ($method === 'POST' && $uri === '/logout') {
    $controller = new AuthController();
    $controller->logout();
    exit;
}

// pelanggaran

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

if ($method === 'PUT' && preg_match('#^/pelanggaran/(\d+)$#', $uri, $matches)) {
    $controller = new PelanggaranController();
    $controller->update($matches[1]);
    exit;
}

if ($method === 'DELETE' && preg_match('#^/pelanggaran/(\d+)$#', $uri, $matches)) {
    $controller = new PelanggaranController();
    $controller->destroy($matches[1]);
    exit;
}

// pembinaan

if ($method === 'GET' && $uri === '/pembinaan') {
    $controller = new PembinaanController();
    $controller->index();
    exit;
}

if ($method === 'POST' && $uri === '/pembinaan') {
    $controller = new PembinaanController();
    $controller->store();
    exit;
}

if ($method === 'PUT' && preg_match('#^/pembinaan/(\d+)$#', $uri, $matches)) {
    $controller = new PembinaanController();
    $controller->update($matches[1]);
    exit;
}

if ($method === 'DELETE' && preg_match('#^/pembinaan/(\d+)$#', $uri, $matches)) {
    $controller = new PembinaanController();
    $controller->destroy($matches[1]);
    exit;
}

//laporan
if ($method === 'GET' && $uri === '/laporan/poin-siswa') {
    $controller = new LaporanController();
    $controller->poinSiswa();
    exit;
}

// Siswa
if ($method === 'GET' && $uri === '/siswa') {
    $controller = new SiswaController();
    $controller->index();
    exit;
}

if ($method === 'GET' && preg_match('#^/siswa/(\d+)$#', $uri, $matches)) {
    $controller = new SiswaController();
    $controller->show($matches[1]);
    exit;
}

if ($method === 'GET' && $uri === '/users') {
    $controller = new UserController();
    $controller->index();
    exit;
}

// testing api

if ($method === 'GET' && $uri === '/ping') {
    echo json_encode([
        "status" => "OK",
        "message" => "API modul sudah berjalan"
    ]);
    exit;
}

// not found/ gagal

http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "endpoint tidak ditemukan"
]);
exit;

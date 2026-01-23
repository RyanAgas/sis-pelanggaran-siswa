<?php

// buat memulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//cek user sudah login atau belum
function isLogin()
{
    return isset($_SESSION['user']);
}

//untuk mengambil data user yg sedang login
function userLogin()
{
    return $_SESSION['user'] ?? null;
}

//ngambil role user yang sedang login
function roleUser()
{
    return $_SESSION['user']['role_name'] ?? null;
}

//untuk user login
function requireLogin()
{
    if(!isLogin()) {
        http_response_code(401);
        echo json_encode([
            "status" => "error",
            "message" => "Silahkan login terlebih dahulu"
        ]);
        exit;
    }
}

//untuk user logout
function logout()
{
    session_unset();   
    session_destroy(); 

    echo json_encode([
        "status" => "success",
        "pesan" => "Logout berhasil"
    ]);
    exit;
}
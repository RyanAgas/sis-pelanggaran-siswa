<?php

class AuthMiddleware {
    
    public static function check()
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode([
                "status" => "error",
                "message" => "Silahkan login terlebih dahulu"
            ]);
            exit;
        }
    }
}
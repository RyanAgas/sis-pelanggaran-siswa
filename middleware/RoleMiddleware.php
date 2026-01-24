<?php

class RoleMiddleware {

    public static function allow(array $roles)
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode([
                "status" => "error",
                "message" => "Silahkan login terlebih dahulu"
            ]);
            exit;
        }

        $userRole = $_SESSION['user']['role_name'];

        if (!in_array($userRole, $roles)) {
            http_response_code(403);
            echo json_encode([
                "status" => "error",
                "message" => "Akses ditolak"
            ]);
            exit;
        }
    }
}
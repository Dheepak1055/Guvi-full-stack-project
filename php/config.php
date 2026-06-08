<?php
// Redis-based session configuration for GUVI project
// Adjust REDIS_HOST and REDIS_PORT if you run Redis on a different host/port.

if (!extension_loaded('redis')) {
    error_log('Redis PHP extension not loaded. Enable ext-redis or install the phpredis extension.');
}

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');

session_name('GUVI_SESSID');

function startRedisSession() {
    if (session_status() === PHP_SESSION_NONE) {
        if (!extension_loaded('redis')) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(["status" => "failed", "message" => "Redis extension is required for session storage"]);
            exit;
        }

        session_start();
    }
}

function destroyRedisSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}
?>
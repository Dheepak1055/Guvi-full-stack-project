<?php
require 'config.php';
startRedisSession();
destroyRedisSession();
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    "status" => "success"
]);
?>
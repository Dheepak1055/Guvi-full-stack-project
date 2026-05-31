<?php

require '../vendor/autoload.php';

$email = $_POST['email'] ?? '';

$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

$redis->del(["session_" . $email]);
echo "Logout Success";
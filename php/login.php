<?php
include "db.php";
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$stmt = $conn->prepare(
    "SELECT name,email,password
     FROM users
     WHERE email = ?"
);
$stmt->bind_param(
    "s",
    $email
);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if(password_verify(
        $password,
        $row["password"]
    )){
        require '../vendor/autoload.php';

        $redis = new Predis\Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ]);
        $redis->set(
            "session_" . $email,
            json_encode([
                "email" => $email,
                "login_time" => time()
            ])
        );
        echo json_encode([
            "status" => "success",
            "name"   => $row["name"],
            "email"  => $row["email"]
        ]);
    }else{
        echo json_encode([
            "status" => "failed"
        ]);
    }
}else{
    echo json_encode([
        "status" => "failed"
    ]);
}
?>
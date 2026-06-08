<?php

include "db.php";
<<<<<<< HEAD

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
=======
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "failed", "message" => "Invalid request method"]);
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    echo json_encode(["status" => "failed", "message" => "Email and password are required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "failed", "message" => "Invalid email address"]);
    exit;
}
>>>>>>> d447dca (Final submission - GUVI Full Stack developer Assignment)

$stmt = $conn->prepare(
    "SELECT id, name, email, password
     FROM users
     WHERE email = ?"
);
<<<<<<< HEAD

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $row = $result->fetch_assoc();

    if(password_verify($password, $row["password"])){

        echo json_encode([
            "status" => "success",
            "name" => $row["name"],
            "email" => $row["email"]
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
=======
if (!$stmt) {
    echo json_encode(["status" => "failed", "message" => "Database error"]);
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($userId, $name, $dbEmail, $hash);

if ($stmt->fetch()) {
    if (password_verify($password, $hash)) {
        // No session creation - authentication state maintained via localStorage on frontend
        echo json_encode([
            "status" => "success",
            "name" => $name,
            "email" => $dbEmail,
            "userId" => $userId
        ]);
        exit;
    }
}

// Authentication failed
echo json_encode(["status" => "failed", "message" => "Invalid email or password"]);
?>
>>>>>>> d447dca (Final submission - GUVI Full Stack developer Assignment)

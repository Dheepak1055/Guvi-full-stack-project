<?php
header('Content-Type: application/json; charset=utf-8');
include "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "failed", "message" => "Invalid request method"]);
    exit;
}

$name = trim($_POST["name"] ?? '');
$email = trim($_POST["email"] ?? '');
$password = trim($_POST["password"] ?? '');

if ($name === '' || $email === '' || $password === '') {
    echo json_encode(["status" => "failed", "message" => "Name, email, and password are required"]);
    exit;
}

if (strlen($name) < 3 || strlen($name) > 50) {
    echo json_encode(["status" => "failed", "message" => "Name must be between 3 and 50 characters"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "failed", "message" => "Invalid email address"]);
    exit;
}

if (strlen($password) < 8) {
    echo json_encode(["status" => "failed", "message" => "Password must be at least 8 characters"]);
    exit;
}

if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    echo json_encode(["status" => "failed", "message" => "Password must contain uppercase, lowercase, and number"]);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
if (!$stmt) {
    echo json_encode(["status" => "failed", "message" => "Database error"]);
    exit;
}
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(["status" => "failed", "message" => "Email already registered"]);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users(name,email,password)
    VALUES(?,?,?)"
);
if (!$stmt) {
    echo json_encode(["status" => "failed", "message" => "Database error"]);
    exit;
}

$stmt->bind_param(
    "sss",
    $name,
    $email,
    $hashedPassword
);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Registration successful"]);
} else {
    echo json_encode(["status" => "failed", "message" => "Registration failed"]);
}
?>
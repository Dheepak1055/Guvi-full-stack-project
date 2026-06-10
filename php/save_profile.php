<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "failed", "message" => "Invalid request method"]);
    exit;
}

$email = trim($_POST["email"] ?? "");

if ($email === "") {
    echo json_encode(["status" => "failed", "message" => "Email parameter required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "failed", "message" => "Invalid email format"]);
    exit;
}

$age = trim($_POST["age"] ?? "");
$dob = trim($_POST["dob"] ?? "");
$contact = trim($_POST["contact"] ?? "");
$bio = trim($_POST["bio"] ?? "");

if ($age === '') {
    echo json_encode(["status" => "failed", "message" => "Age is required"]);
    exit;
}

if (!ctype_digit($age) || (int)$age < 18 || (int)$age > 100) {
    echo json_encode(["status" => "failed", "message" => "Age must be between 18 and 100"]);
    exit;
}

if (!preg_match('/^[0-9]{10}$/', $contact)) {
    echo json_encode(["status" => "failed", "message" => "Contact must be exactly 10 digits"]);
    exit;
}

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->guvi_mongo->profiles;

    $collection->updateOne(
        ["email" => $email],
        [
            '$set' => [
                "email" => $email,
                "age" => $age,
                "dob" => $dob,
                "contact" => $contact,
                "bio" => $bio
            ]
        ],
        ["upsert" => true]
    );

    echo json_encode([
        "status" => "success",
        "message" => "Profile saved successfully"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => "failed",
        "message" => $e->getMessage()
    ]);
}
?>

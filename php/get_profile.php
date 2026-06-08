<?php
header('Content-Type: application/json; charset=utf-8');
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(["status" => "failed", "message" => "Invalid request method"]);
    exit;
}

// Get email from frontend via GET parameter (from localStorage)
$email = trim($_GET["email"] ?? "");

if ($email === "") {
    echo json_encode(["status" => "failed", "message" => "Email parameter required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "failed", "message" => "Invalid email format"]);
    exit;
}

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->guvi_mongo->profiles;
    $document = $collection->findOne(["email" => $email]);

    if ($document === null) {
        echo json_encode([
            "status" => "success",
            "email" => $email,
            "age" => "",
            "dob" => "",
            "contact" => "",
            "bio" => ""
        ]);
        exit;
    }

    echo json_encode([
        "status" => "success",
        "email" => $email,
        "age" => isset($document->age) ? $document->age : "",
        "dob" => isset($document->dob) ? $document->dob : "",
        "contact" => isset($document->contact) ? $document->contact : "",
        "bio" => isset($document->bio) ? $document->bio : ""
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "failed", "message" => "MongoDB Error: " . $e->getMessage()]);
}
?>
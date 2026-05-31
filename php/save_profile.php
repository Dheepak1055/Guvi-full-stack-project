<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../vendor/autoload.php';
try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->guvi_mongo->profiles;
    $email = $_POST["email"] ?? "";
    $age = $_POST["age"] ?? "";
    $dob = $_POST["dob"] ?? "";
    $contact = $_POST["contact"] ?? "";
    $bio = $_POST["bio"] ?? "";
    $result = $collection->updateOne(
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
    echo "Profile Saved Successfully";
} catch (Exception $e) {
    echo "MongoDB Error : " . $e->getMessage();
}
?>
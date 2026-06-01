<?php

$conn = new mysqli(
    "localhost",
    "guviuser",
    "Guvi@123",
    "guvi_project"
);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>

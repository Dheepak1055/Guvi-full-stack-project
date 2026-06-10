<?php

$conn = new mysqli(
    "localhost",
    "guviuser",
    "Guvi@123",
    "guvi_project"
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<?php
<<<<<<< HEAD

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
=======
$conn = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "guvi project",
    3307
);

if ($conn->connect_error) {
    die($conn->connect_error);
}
?>
>>>>>>> d447dca (Final submission - GUVI Full Stack developer Assignment)

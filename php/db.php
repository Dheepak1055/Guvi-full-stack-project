<?php
$conn=new mysqli(
    "localhost",
    "root",
    "",
    "Guvi project",
    3307
);
if($conn->connect_error){
    die("Connection Failed");
}
?>
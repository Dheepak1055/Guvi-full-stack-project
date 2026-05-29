<?php
include "db.php";
$name=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];
$stmt=$conn->prepare(
    "INSERT INTO users(name,email,password)
    VALUES(?,?,?)"
);
$stmt->bind_param(
    "sss",
    $name,
    $email,
    $password
);
if($stmt->execute()){
    echo "Registration Successful";
}
else{
    echo "Registration Failed";
}
?>
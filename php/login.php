<?php
include "db.php";
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$stmt = $conn->prepare(
    "SELECT * FROM users 
     WHERE email = ? AND password = ?"
);
$stmt->bind_param(
    "ss",
    $email,
    $password
);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    echo "Login Successful";
}
else{
    echo "Invalid Credentials";
}
?>
<?php
    $conn = new mysqli(
        "127.0.0.1",
        "root",
        "",
        "guvi project",
        3307
    );

    if($conn->connect_error){
        die($conn->connect_error);
    }
?>
<?php
    $servername = "localhost";
    $database = "facebook";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password, $database);
    if(!$conn)
    {
        die ("Não foi possivel conectar".mysqli_connect_error());
    }
?>
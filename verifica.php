<?php
session_start();
include("conecta.php");

$email = $_POST["email"];
$senha = sha1(($_POST["senha"]));

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'") or die(mysqli_error());

if(mysqli_num_rows($query) > 0)
{
    $dados = mysqli_fetch_assoc($query);

    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['id'] = $dados['id'];

    http_response_code(200);
}
else http_response_code(400);

mysqli_close($conn);
?>
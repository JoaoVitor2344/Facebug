<?php
session_start();
include("conecta.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = sha1(($_POST["senha"]));

$query = mysqli_query($conn,"SELECT email FROM usuarios WHERE email = '$email'") or die(mysqli_error());

if(mysqli_num_rows($query) > 0)
{ 
    http_response_code(400); // Já cadastrado
}
else
{
    $sql = "INSERT INTO usuarios(nome,email,senha) VALUES('$nome','$email','$senha')";
    if(mysqli_query($conn, $sql))
    {
        $_SESSION['nome'] = $nome;
        http_response_code(200); // Cadastro concluido
    } 
    else http_response_code(500); // Não foi possivel cadastrar
}

mysqli_close($conn);
?>
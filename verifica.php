<?php
session_start();
include("conecta.php");

$email = $_POST["Email"];
$senha = $_POST["senha"];

$query = mysqli_query($conn, "SELECT * FROM pessoas WHERE email = '$email' and senha = '$senha'") or die(mysqli_error());
if(mysqli_num_rows($query) > 0)
{
    echo "<script> 
    window.location.href = 'principal.php';
    </script>";

    $dados = mysqli_fetch_assoc($query);

    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['id'] = $dados['id'];

    $loggedin = time();

    $sql = mysqli_query($conn, "
    UPDATE pessoas 
    SET loggedin = '$loggedin'
    WHERE id = '".$_SESSION['id']."'");

    // End logado

    if(!file_exists('publicações/'.$_SESSION['id'].'.php'))
    {
        file_put_contents('publicações/'.$_SESSION['id'].'.php', '<!-- 1 -->
<!-- -1- -->');
    }
    if(!file_exists('usuarios/foto perfil/'.$_SESSION['id'].'.jpg'))
    {
        copy('usuarios/foto perfil/default.jpg', 'usuarios/foto perfil/'.$_SESSION['id'].'.jpg');
    }
    if(!file_exists('usuarios/foto capa/'.$_SESSION['id'].'.jpg'))
    {
        copy('usuarios/foto capa/default.jpg', 'usuarios/foto capa/'.$_SESSION['id'].'.jpg');
    }
}
else
{
    echo "<script> 
    alert('Email ou senha incorretos!'); 
    window.location.href = 'index.php';
    </script>";
}
mysqli_close($conn);
?>
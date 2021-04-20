<?php
session_start();
include("conecta.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = sha1($_POST["senha"]);

$query = mysqli_query($conn,"SELECT email FROM usuarios WHERE email = '".$email."'") or die(mysqli_error());

if(mysqli_num_rows($query) > 0){ echo "<script> alert('Já cadastrado!'); </script>"; }
else
{
    $sql = "INSERT INTO usuarios(nome,email,senha) VALUES('".$nome."','".$email."','".$senha."')";
    if(mysqli_query($conn, $sql))
    {
        $_SESSION['nome'] = $nome;

        echo "<script>
        alert('Cadastro concluido!');
        window.location.href = 'login.php';
        </script>";
    } 
    else 
    {
        echo "<script>
        alert('Não foi possivel cadastrar!');
        window.location.href = 'login.php';
        </script>";
    }
}

mysqli_close($conn);
?>
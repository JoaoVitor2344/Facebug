<?php
session_start();
include("conecta.php");
$nome = $_POST["nome"];
$email = $_POST["Email"];
$senha = $_POST["senha"];

$query = mysqli_query($conn, "SELECT email FROM pessoas WHERE email = '$email'") or die(mysqli_error());
if(mysqli_num_rows($query) > 0)
{
    echo "<script> alert('Já cadastrado!'); </script>";
}
else
{
    $sql = "INSERT INTO pessoas(nome,email,senha) VALUES('$nome','$email','$senha')";
    if(mysqli_query($conn, $sql))
    {
        $_SESSION['nome'] = $nome;
        include('criar_usuario.php');

        echo "<script>
        alert('Cadastro concluido!');
        window.location.href = 'index.php';
        </script>";
    } 
    else 
    {
        echo "<script>
        alert('Não foi possivel cadastrar!');
        window.location.href = 'index.php';
        </script>";
    }
}
mysqli_close($conn);
?>
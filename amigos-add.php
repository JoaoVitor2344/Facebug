<?php 
session_start();
include("conecta.php");

$id = $_GET['id'];
$session = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT amigos FROM pessoas WHERE id = '$session'");
$dados = mysqli_fetch_assoc($query);

$dados = $dados['amigos'] . " " . $id;

$sql = "UPDATE pessoas SET amigos = '$dados' WHERE id = '$session'";
if(mysqli_query($conn, $sql) or die(mysqli_error($conn)))
{
    echo "<script>
    window.location.href='amigos-sugestao.php';
    </script>";
} 
mysqli_close($conn);
?>
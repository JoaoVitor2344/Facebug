<?php
session_start();
include("conecta.php");

$id = $_GET['id'];
$session = $_SESSION['id'];
$conteudo = $_POST['conteudo'];

$sql = "UPDATE publicações SET conteudo = '$conteudo' WHERE id = '$id' and id_usu = '$session'";
if(mysqli_query($conn, $sql))
{
    echo "<script> 
    window.location.href = 'http://localhost/facebook2/profile.php?id=".$session."';
    </script>";  
}
mysqli_close($conn);
?>
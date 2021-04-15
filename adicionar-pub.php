<?php
session_start();
include("conecta.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo'); 
$data_atual = strftime('%d/%B/%Y'); 

$id = $_SESSION['id'];
$conteudo = $_POST['conteudo'];
$time = date('H:i');
$date = date('Y-m-d');

if($_FILES['arquivo']['size'] > 0)   
{
    $directory = "imagens/";
    $filecount = 0;
    $files = glob($directory . "*");
    if($files)
    {
        $filecount = count($files);
    }
    $id_img = $filecount + 1;

    move_uploaded_file($_FILES['arquivo']['tmp_name'], 'imagens/'.$id_img.'.jpg');
}
else
{
    $id_img = 0;
}

$sql = mysqli_query($conn, "INSERT INTO publicações(id_usu,id_img,conteudo,hora,data) VALUES('".$id."','".$id_img."','".$conteudo."','".$time."','".$date."')") or die(mysqli_error($conn));

echo "<script>
window.location.href='profile.php?id=".$id."';
</script>";

?>
<?php 
session_start();
$id = $_SESSION['id'];
$form = $_GET['form'];	

if($_FILES['arquivo']['error'] != 0)
{
	die($_FILES['arquivo']['error']);
}

if($form == "perfil")
{
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'], 'usuarios/foto perfil/'.$id.'.jpg'))
	{
		echo "<script>
		window.location.href='profile.php?id=".$id."';
		</script>";
	}	
}
else
{
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'], 'usuarios/foto capa/'.$id.'.jpg'))
	{
		echo "<script>
		window.location.href='profile.php?id=".$id."';
		</script>";
	}
}

?>
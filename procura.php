<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		a{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 16px;
			color: white;
		}
		.body{
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		.pessoas{
			background: rgb(73, 80, 87);
			width: 600px;
			padding: 10px;
			margin: 10px 0 10px 10px;
			border: none;
			border-radius: 15px;
			display: block;
		}
		.pessoas button{
			background: black;
			cursor: pointer;
			font-size: 16px;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 15px;
		}
		.info{
			display: flex;
			text-align: center;
		}
		.info img{
			width: 60px;
			height: 60px;
			border-radius: 100%;
		}
		.right{
			float: right;
			margin-top: -10%;
		}
	</style>
</head>
<body>
	<?php
	include("menu.php");
	include("conecta.php");

	$nome = $_POST['procura'];
	$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE nome LIKE '$nome%'") or die(mysqli_error($conn));

	if(mysqli_num_rows($query) > 0)
	{
		echo '<div class="body">';
		while($dados = mysqli_fetch_assoc($query))
		{
			echo '<div class="pessoas">
			<div class="info">
				<img src="usuarios/foto perfil/'.$dados['id'].'.jpg">
				<a>'.$dados['nome'].'</a>
			</div>';
			if($_SESSION['id'] != $dados['id'])
			{
				echo '<div class="right">
					<a href="amigos-add.php?id='.$dados['id'].'">
						<button>Adicionar</button>
					</a>
				</div>';
			}
			echo '</div>';
		}
		echo'</div>';
	}
	else
	{
		$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE nome LIKE '%$nome%'") or die(mysqli_error($conn));

		if(mysqli_num_rows($query) > 0)
		{
			echo '<div class="body">';
		while($dados = mysqli_fetch_assoc($query))
		{
			echo 
			'<div class="pessoas">
				<div class="info">
					<img src="usuarios/foto perfil/'.$dados['id'].'.jpg">
					<a>'.$dados['nome'].'</a>
				</div>
				<div class="right">
					<a href="amigos-add.php?id='.$dados['id'].'">
						<button>Adicionar</button>
					</a>
				</div>
			</div>';
		}
		echo'</div>';
		}

	}
	mysqli_close($conn);
	?>
</body>
</html>


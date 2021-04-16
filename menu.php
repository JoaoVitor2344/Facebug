<style type="text/css">
	*{
		font-family: Arial, Helvetica, sans-serif;
		text-decoration: none;
	}
	body{
	 	background-color: rgb(73, 80, 87);  
	 	margin: 0;
	}
	.menu{
		background: rgb(33, 37, 41);
		padding: 10px;
		display: flex;
		justify-content: space-between;
	}
	.menu .icone{
		width: 35px;
		border-radius: 100px;
		position: absolute;
	}
	.menu input{
		border: none;
		border-radius: 100px;
		font-size: 16px;
		padding: 10px 15px;
		margin-left: 40px;
	}
	.menu-left, .menu-right{
		cursor: pointer;
	}
	.menu-right{
		margin-right: 0;
		display: flex;
		cursor: pointer;
	}
	.menu-right img{
		width: 35px;
		height: 35px;
		border-radius: 100px;
	}
	.menu-right .nome{
		color: white;
		padding: 10px;
	}
	@media(max-width: 375px){
		.menu input{
			visibility: hidden;
		}
	}
</style>
<div class="menu"> 
	<div class="menu-left">
		<img class="icone" src="icone.jpg" onclick="window.location.href='index.php';">
		<form method="POST" action="procura.php" autocomplete="on">
			<input type="text" name="procura" placeholder="Pesquisar">
		</form>
	</div>
	<div class="menu-right">
		<?php 

		$url = $_SERVER["REQUEST_URI"];

		if(strstr($url, 'index') == false)
		{
		    session_start();
		}

		echo '
		<a href="profile.php?id='.$_SESSION['id'].'">
			<img src="usuarios/foto perfil/'.$_SESSION['id'].'.jpg">
			<a class="nome">'.$_SESSION['nome'].'</a>
		</a>';

		?>

		<a href="login.php">Sair</a>
	</div>
</div>
<style type="text/css">
	*{
		font-family: Arial, Helvetica, sans-serif;
		text-decoration: none;
	    color: rgb(233, 236, 239);
	}
	body{
	 	background-color: rgb(73, 80, 87);  
	 	margin: 0;
	}
	.menu{
		display: flex;
		justify-content: space-between;

		background: rgb(33, 37, 41);
		padding: 10px;
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
		color: black;
	}
	.menu-left, .menu-right{
		cursor: pointer;
		align-items: center;
	}
	.menu-right{
		display: flex;

		cursor: pointer;
	}
	.menu-right img{
		width: 35px;
		height: 35px;
		border-radius: 100px;
	}
	.menu-right .nome, .menu_right a{
		color: white;
		padding: 10px;
	}
	@media(max-width: 375px){
		.menu input{
			visibility: hidden;
		}
	}

	.menu-dropdown{
		margin-right: 10px;
		margin-left: 10px;
	}
	.menu-btn div{
		background: rgb(206, 212, 218);
		padding: 2px 15px;
		border-radius: 15px;
		margin-bottom: 2px;
	}
	#menu-content{
		position: absolute;
		display: none;
		flex-direction: column;

		background: rgb(52, 58, 64);
		right: 5px;
		margin-top: 10px;
	}
	#menu-content div{
		text-align: center;
		padding: 10px;
	}
	 #menu-content div:hover{
		background: rgb(73, 80, 87);
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
		if($url != "/facebug/index.php" and $url != "/facebug/") session_start();

		echo '
		<a href="profile.php?id='.$_SESSION['id'].'">
			<img src="usuarios/foto perfil/'.$_SESSION['id'].'.jpg">
			<a class="nome">'.$_SESSION['nome'].'</a>
		</a>';
		
		?>
		<div class="menu-dropdown">
			<div class="menu-btn" onclick="dropdown()">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div id="menu-content">
				<div><a href="logout.php">Sair</a></div>
				<div>teste</div>
				<div>teste</div>
			</div>
			<script type="text/javascript">
				var state = 'none';

				function dropdown(){
					if(state == 'none')
					{
						var dropdown = document.getElementById('menu-content').style.display = 'flex';
						state = dropdown;
					}
					else
					{
						var dropdown = document.getElementById('menu-content').style.display = 'none';
						state = dropdown;
					}
				}
			</script>
		</div>
	</div>
</div>
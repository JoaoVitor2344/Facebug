<?php session_start(); session_destroy(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Facebook 2</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="shortcut icon" href="icone.ico">
</head>
<body>
    <div class="logar">
        <button class="btnlogin" onclick="document.getElementById('login').style.display = 'block';document.getElementById('cadastra').style.display = 'none';document.getElementById('usuarios').style.display = 'none';">Login</button>
        <button class="btncad" onclick="document.getElementById('login').style.display = 'none';document.getElementById('cadastra').style.display = 'block';document.getElementById('usuarios').style.display = 'none';">Cadastrar</button>
        <button class="btnusu" onclick="document.getElementById('login').style.display = 'none';document.getElementById('cadastra').style.display = 'none';document.getElementById('usuarios').style.display = 'block';">Usuarios</button> 
        <div class="login" id="login">
            <form action="verifica.php" method="POST" target="_self" autocomplete="on">
                <label>Email</label><br><br>
                <input type="email" name="Email" placeholder="Digite o seu email"><br><br>
                <label>Senha</label><br><br>
                <input type="password" name="senha" placeholder="Digite a sua senha"><br><br>
                <button type="submit">Logar</button>
            </form>
        </div>
        <div class="cadastra" id="cadastra">
            <form action="cadastra.php" method="POST" target="_self" autocomplete="on">
                <label>Nome</label><br><br>
                <input type="text" name="nome" placeholder="Digite o seu nome"><br><br>
                <label>Email</label><br><br>
                <input type="email" name="Email" placeholder="Digite o seu email"><br><br>
                <label>Senha</label><br><br>
                <input type="password" name="senha" placeholder="Digite a sua senha"><br><br>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
        <div class="usuarios" id="usuarios">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Amigos</th>
                </tr>
                <?php 
                include("conecta.php");
                $query = mysqli_query($conn, "SELECT * FROM pessoas ORDER BY id");
                while($dados = mysqli_fetch_assoc($query))
                {
                    $loggedin = $dados['loggedin'] + 2;
                    $loggedtime = time(); //2 minutos

                    if($loggedin > $loggedtime) { $status = "online"; }
                    else { $status = "offline"; }

                    setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "pt_BR.utf-8", "portuguese");
                    date_default_timezone_set("America/Sao_Paulo"); 

                    echo
                    '<tr>
                        <th><a>'.date("d/m/Y H:i:s", $dados['loggedin']).'</a></th>
                        <th><a class="'.$status.'">'.$status.'</a></th>
                        <th><a href="profile.php?id='.$dados['id'].'">'.$dados['nome'].'</a></th>
                        <th><a>'.$dados['amigos'].'</a></th>
                    </tr>';
                }
                mysqli_close($conn);
                ?> 
            </table>
        </div>
    </div>
    <div class="right">
        <div class="body">
            <h1>Eu sou o criador do <h1 style="color: blue;">Facebug</h1></h1>
            <img src="usuarios/foto perfil/1.jpg">
            <h3>João Vitor</h3>
        </div>
        <div class="footer">
            <a href="profile.php?id=1">Perfil do Criador</a>
        </div>
    </div>
 </body>
 </html>
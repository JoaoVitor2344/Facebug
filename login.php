<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Facebook 2</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="logar">
        <button class="btn btnlogin" onclick="document.getElementById('login').style.display = 'block';document.getElementById('cadastra').style.display = 'none';document.getElementById('usuarios').style.display = 'none';">Login</button>
        <button class="btn btncad" onclick="document.getElementById('login').style.display = 'none';document.getElementById('cadastra').style.display = 'block';document.getElementById('usuarios').style.display = 'none';">Cadastrar</button>
        <button class="btn btnusu" onclick="document.getElementById('login').style.display = 'none';document.getElementById('cadastra').style.display = 'none';document.getElementById('usuarios').style.display = 'block';">Usuarios</button> 

        <div class="form login" id="login">
            <form action="verifica.php" method="POST" target="_self" autocomplete="on">
                <label>Email</label><br><br>
                <input type="email" name="email" placeholder="Digite o seu email"><br><br>
                <label>Senha</label><br><br>
                <input type="password" name="senha" placeholder="Digite a sua senha"><br><br>
                <button type="submit">Logar</button>
            </form>
        </div>
        <div class="form cadastra" id="cadastra">
            <form action="cadastra.php" method="POST" target="_self" autocomplete="on">
                <label>Nome</label><br><br>
                <input type="text" name="nome" placeholder="Digite o seu nome"><br><br>
                <label>Email</label><br><br>
                <input type="email" name="email" placeholder="Digite o seu email"><br><br>
                <label>Senha</label><br><br>
                <input type="password" name="senha" placeholder="Digite a sua senha"><br><br>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
        <div class="form usuarios" id="usuarios">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Amigos</th>
                </tr>
                <?php
                include("conecta.php");

                $query = mysqli_query($conn, "SELECT * FROM usuarios") or die(mysqli_error());

                while ($dados = mysqli_fetch_assoc($query))
                {
                    echo 
                    '<tr>
                        <th>'.$dados['nome'].'</th>
                        <th>'.$dados['email'].'</th>
                        <th>'.$dados['amigos'].'</th>
                    </tr>';
                }
                ?>
            </table>
        </div>
    </div>
 </body>
 </html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Facebook 2</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <script type="text/javascript" src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        function verifica(){
          email = document.getElementById("email").value;
          senha = Encripta(document.getElementById("senha").value);

          $.ajax({
            type: "POST",
            url: "verifica.php",
            data: { "email": email, "senha": senha},
            success: function(){
              window.location.href = 'index.php'
            },
            error: function(){
              alert('Email ou Senha incorreto!')
            }
          });    
        }

        function cadastra(){
          nome = document.getElementById("nome-cad").value;
          email = document.getElementById("email-cad").value;
          senha = Encripta(document.getElementById("senha-cad").value);

          $.ajax({
            type: "POST",
            url: "cadastra.php",
            data: { "nome": nome, "email": email, "senha": senha},
            onResponse: function(response){
                if(response.result == 200) 
                {
                    alert("Email já cadastrado");
                }
                else if(response.result == 400)
                {
                    alert("Cadastro concluido");
                }
                else if(response.result == 500)
                {
                    alert("Erro no sistema");
                }
            }
          });    
        }

        var ch = "assbdFbdpdPdpfPdAAdpeoseslsQQEcDDldiVVkadiedkdkLLnm"; 

        function Asc(String){ return String.charCodeAt(0); }
        function Chr(AsciiNum){ return String.fromCharCode(AsciiNum); } 
        function Encripta(dados){
            var texto = "";
            var len;
            var j = 0;
            for (var i = 0; i < dados.length; i++)
            {
                j++;
                len = (Asc(dados.substr(i,1)) + (Asc(ch.substr(j,1))));
                if (j==50) j=1; 
                if (len > 255) len-=256;
                texto+=(Chr(len));
            }

            return texto;
        }
        // function Descripta(dados){
        //     var texto = "";
        //     var len;
        //     var j = 0;
        //     for (var i = 0; i < dados.length; i++){
        //         j++;
        //         len = (Asc(dados.substr(i,1)) - (Asc(ch.substr(j,1))));
        //         if (j==50) j=1;
        //         if (len < 0) len += 256; 
        //         texto+=(Chr(len));
        //     }   
        //     document.getElementById("2").value = texto;
        // }
        
    </script>
</head>
<body>
    <div class="logar">
        <button class="btn btnlogin" onclick="document.getElementById('login').style.display = 'block';document.getElementById('cadastra').style.display = 'none';document.getElementById('usuarios').style.display = 'none';">Login</button>
        <button class="btn btncad" onclick="document.getElementById('login').style.display = 'none';document.getElementById('cadastra').style.display = 'block';document.getElementById('usuarios').style.display = 'none';">Cadastrar</button>
        <button class="btn btnusu" onclick="document.getElementById('login').style.display = 'none';document.getElementById('cadastra').style.display = 'none';document.getElementById('usuarios').style.display = 'block';">Usuarios</button> 

        <div class="form login" id="login">
            <label>Email</label><br><br>
            <input type="email" name="email" id="email" placeholder="Digite o seu email"><br><br>
            <label>Senha</label><br><br>
            <input type="password" name="senha" id="senha" placeholder="Digite a sua senha"><br><br>
            <button type="submit" onclick="verifica();">Logar</button>
        </div>
        <div class="form cadastra" id="cadastra">
            <label>Nome</label><br><br>
            <input type="text" name="nome" id="nome-cad" placeholder="Digite o seu nome"><br><br>
            <label>Email</label><br><br>
            <input type="email" name="email" id="email-cad" placeholder="Digite o seu email"><br><br>
            <label>Senha</label><br><br>
            <input type="password" name="senha" id="senha-cad" placeholder="Digite a sua senha"><br><br>
            <button type="submit" onclick="cadastra();">Cadastrar</button>
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Facebook 2</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="shortcut icon" href="icone.ico">
</head>
<body>
    <div class="nav-bar">
        <?php include("menu.php"); ?>
        
        <div class="capa">
            <?php 
            $id = $_GET['id'];
            echo 
            '<img class="foto-capa" src="usuarios/foto capa/'.$id.'.jpg">
            <button class="open-button-file" onclick="openFormcapa()"></button>';
            ?>
        </div>
        <div class="info">
            <?php 
            $id = $_GET['id'];
            echo '<img class="open-button-file" src="usuarios/foto perfil/'.$id.'.jpg" onclick="openForminput()">'; 
            ?>
            <a style="font-size: xx-large;">
                <?php  
                include('conecta.php');
                
                $id = $_GET['id'];
                $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = ".$id."") or die(mysqli_error());
                
                if(mysqli_num_rows($query) > 0)
                {
                    $dados = mysqli_fetch_assoc($query);
                    echo $dados['nome'];    
                }
                
                mysqli_close($conn);
                ?>
            </a>
            <a style="font-size: large;">Biografia</a>
        </div>
        <div class="form-popup-file" id="myForm2">
            <form method="POST" action="alterar-foto.php?form=perfil" class="form-container-file" enctype="multipart/form-data">
                <label for="file">Perfil</label>
                <input type="file" id="file" name="arquivo">
                <button type="submit" class="btn-file">Alterar</button>
                <button type="button" class="btn-cancel-file" onclick="closeForminput()">Cancelar</button>
            </form>
        </div>
        <div class="form-popup-file" id="myForm3">
            <form method="POST" action="alterar-foto.php?form=capa" class="form-container-file" enctype="multipart/form-data">
                <label for="file">Capa</label>
                <input type="file" id="file" name="arquivo">
                <button type="submit" class="btn-file">Alterar</button>
                <button type="button" class="btn-cancel-file" onclick="closeFormcapa()">Cancelar</button>
            </form>
        </div>
        <script>
            function openForminput() {
                document.getElementById("myForm2").style.display = "block";
            }

            function closeForminput() {
                document.getElementById("myForm2").style.display = "none";
            }

            function openFormcapa() {
                document.getElementById("myForm3").style.display = "block";
            }

            function closeFormcapa() {
                document.getElementById("myForm3").style.display = "none";
            }
        </script>
    </div>
    <div class="body">
        <div class="outros">
            <div class="nav">
                <h3>Amigos</h3>
                <?php 

                $id = $_GET['id']; 
                $session  = $_SESSION['id'];

                if($id == $session)
                {
                    echo '<br><a href="amigos-sugestao.php" style="font-size: 18px;">Encontrar amigos</a>';
                }  

                ?>
            </div>
            <div class="amigos">
                <?php 
                include("conecta.php");

                $id = $_GET['id'];
                $query = mysqli_query($conn, "SELECT amigos FROM usuarios WHERE id = '".$id."'") or die(mysqli_error());

                if(mysqli_num_rows($query) > 0)
                {
                    $dados = mysqli_fetch_assoc($query);

                    $array = str_split($dados['amigos'],1);
                    $length = count($array);

                    foreach (array_keys($array, " ") as $key) 
                    {
                        unset($array[$key]);
                    }

                    foreach($array as $key)
                    {
                        $id = $key;
                        $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '".$id."'") or die(mysqli_error());

                        if(mysqli_num_rows($query) > 0)
                        {
                            $dados = mysqli_fetch_assoc($query);
                            echo 
                            "<div>
                                <a href='/facebook2/profile.php?id=".$dados['id']."'>
                                    <img src='usuarios/foto perfil/".$dados['id'].".jpg'>
                                    <a>".$dados['nome']."</a>
                                </a>
                            </div>";
                        }
                    }
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
        <div class="principal">
            <?php 
            include("conecta.php");

            $id = $_GET['id'];
            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '".$id."'") or die(mysqli_error());

            if(mysqli_num_rows($query) > 0)
            {
                $dados = mysqli_fetch_assoc($query);
                $nome = $dados['nome'];
                if($dados['id'] == $_SESSION['id'])
                {
                    echo 
                    '<div class="publicar">
                        <form  method="POST" action="adicionar-pub.php" target="_self" enctype="multipart/form-data">
                            <label>Publicar</label>
                            <input type="text" name="conteudo" placeholder="Oque vc quer publicar hj?">
                            <button class="btn-file" type="button" id="button-file" for="file"> Foto </button>
                            <input class="file" type="file" id="file" name="arquivo">
                            <button class="btn-pub" type="submit">Publicar</button>
                        </form>
                    </div>
                    <script type="text/javascript">
                        const realFileBtn = document.getElementById("file");
                        const customBtn = document.getElementById("button-file");

                        customBtn.addEventListener("click", function() {
                            realFileBtn.click();
                        });

                        realFileBtn.addEventListener("change", function() {
                            if (realFileBtn.value) {
                                customTxt.innerHTML = realFileBtn.value.match(
                                    /[\/\\]([\w\d\s\.\-\(\)]+)$/
                                    )[1];
                            } else {
                                customTxt.innerHTML = "Nenhum arquivo selecionado.";
                            }
                        });
                    </script>
                    ';
                }

                $query = mysqli_query($conn, "SELECT * FROM publicações WHERE id_usu = '$id'") or die(mysqli_error($conn));
                if(mysqli_num_rows($query) > 0)
                {
                    while ($dados = mysqli_fetch_assoc($query))
                    {
                        if(date('Y-m-d') == $dados['data'])
                        {
                            $data = $dados['hora'];
                        }        
                        else
                        {
                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                            date_default_timezone_set('America/Sao_Paulo'); 
                            $data = strftime('%d/%b/%Y', strtotime($dados['data'])); //mostrará 09/janeiro/2008.
                        }

                        if($dados['id_img'] != 0) { $img = '<img src="imagens/'.$dados['id_img'].'.jpg">'; }
                        else { $img = ''; }

                        $id = $dados['id'];

                        echo'
                        <div class="publicação"> 
                            <div class="pub-bar">
                                <div class="info-pub">
                                    <img src="usuarios/foto perfil/'.$_GET['id'].'.jpg"> 
                                    <div>
                                        <a>'.$nome.'</a>
                                        <span>'.$data.'</span>
                                    </div>
                                </div>
                                ';
                                if($_GET['id'] == $_SESSION['id'])
                                {
                                    echo
                                '<div class="dropdown">
                                    <button class="dropbtn">Opções</button>
                                    <div class="dropdown-content">
                                        <a href="excluir-pub.php?id='.$id.'">Excluir</a>
                                        <a class="open-button" onclick="openForm()">Editar</a>
                                    </div>
                                </div>';
                                }
                            echo 
                            '</div>
                            <div class="conteudo">
                                <a>'.$dados['conteudo'].'</a>
                                '.$img.'
                            </div>
                        </div>
                        <div class="form-popup" id="myForm">
                            <form method="POST" action="editar-pub.php?id='.$id.'" class="form-container">
                                <h1>Edição</h1>
                                <label for="email"><b>Publicação</b></label>
                                <input type="text" name="conteudo" required>
                                <button type="submit" class="btn">Editar</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Cancelar</button>
                            </form>
                        </div>
                        <script>
                            function openForm() {
                                document.getElementById("myForm").style.display = "block";
                            }

                            function closeForm() {
                                document.getElementById("myForm").style.display = "none";
                            }
                        </script>';
                    }
                }

            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>
</body>
</html>
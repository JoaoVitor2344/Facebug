<?php 
session_start();

if(!isset($_SESSION['id'])) header("Location:login.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Facebook 2</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body onload="time()">
    <?php include("menu.php"); ?>

    <div class="body">
        <div class="seila div">
            <a>Seila</a>
            <div class="conteudo">
                <?php 
                for ($i=0; $i < 10; $i++) 
                { 
                    echo '<div>
                        <a>Seila</a>
                    </div>';                    
                }
                ?>
            </div>
        </div>
        <div class="principal">
            <?php 
            include("conecta.php");

            $id = $_SESSION['id'];
            $query = mysqli_query($conn, "SELECT amigos FROM usuarios WHERE id = '".$id."'") or die(mysqli_error());
            
            if(mysqli_num_rows($query) > 0)
            {
                $dados = mysqli_fetch_assoc($query);
                $array = str_split($dados['amigos'],1);
                $len = count($array);
                foreach (array_keys($array, " ") as $key) { unset($array[$key]); }

                setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "pt_BR.utf-8", "portuguese");
                date_default_timezone_set("America/Sao_Paulo"); 
                $data_atual = strftime("%d/%B/%Y"); 
                $datas = array();

                foreach ($array as $key) 
                { 
                    if($key !== "")
                    {
                        $query = mysqli_query($conn, "SELECT * FROM publicacao WHERE id_usu = ".$key) or die(mysqli_error($conn));

                        while ($dados = mysqli_fetch_assoc($query)) 
                        {
                            if($dados['data'] == date('Y-m-d'))
                            {
                                $datas[] = $dados['hora'];
                            }
                            else
                            {
                                $datas[] = $dados['data'];
                            } 
                        }
                    }
                }

                sort($datas);

                foreach ($array as $id) 
                {
                    $query = mysqli_query($conn, "SELECT * FROM publicacao WHERE id_usu = '".$id."'") or die(mysqli_error($conn));
                    if(mysqli_num_rows($query) > 0)
                    {
                        $query2 = mysqli_query($conn, "SELECT nome FROM usuarios WHERE id = '".$id."'");
                        $nome = mysqli_fetch_assoc($query2);
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

                            if($dados['id_img'] != 0)
                            {
                                $img = '<img src="imagens/'.$dados['id_img'].'.jpg">';
                            }
                            else
                            {
                                $img = '';
                            }

                            echo'<div class="publicação div"> 
                                    <div class="info-pub">
                                        <img src="usuarios/foto perfil/'.$id.'.jpg"> 
                                        <div>
                                            <a href="profile.php?id='.$id.'">'.$nome['nome'].'</a>
                                            <span>'.$data.'</span>
                                        </div>
                                    </div>
                                <div class="conteudo">
                                    <a>'.$dados['conteudo'].'</a>
                                    '.$img.'
                                </div>
                            </div>';
                        }
                    }
                }
            }

            mysqli_close($conn);
            ?>
        </div>
        <div class="outros">
            <button class="btnlogin" onclick="
            document.getElementById('outros1').style.display = 'flex'; 
            document.getElementById('outros2').style.display = 'none';
            document.getElementById('outros3').style.display = 'none'; 
            ">Amigos</button>

            <button class="btncad" onclick="
            document.getElementById('outros1').style.display = 'none'
            document.getElementById('outros2').style.display = 'flex';
            document.getElementById('outros3').style.display = 'none'; 
            ">Seila</button>

            <button class="btnusu" onclick="
            document.getElementById('outros1').style.display = 'none'; 
            document.getElementById('outros2').style.display = 'none';
            document.getElementById('outros3').style.display = 'flex'; 
            ">Seila</button> 

            <div class="outros1 div" id="outros1">
                <h3>Amigos</h3>
                <div class="amigos">
                    <?php 
                    include("conecta.php");

                    $id = $_SESSION['id'];
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

                                echo '<div>
                                    <a href="profile.php?id='.$dados['id'].'">
                                        <img src="usuarios/foto perfil/'.$dados['id'].'.jpg">
                                        <a>'.$dados['nome'].'</a>
                                    </a>
                                </div>';
                            }
                        }
                    }
                    mysqli_close($conn);
                    ?>
                </div>
                <?php 
                echo '<br><a href="amigos-sugestao.php" style="font-size: 18px;">Encontrar amigos</a>';
                ?>
            </div>
            <div class="outros2 div" id="outros2">
            </div>
            <div class="outros3 div" id="outros3">
            </div>
        </div>
    </div>

    <!-- <script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        var loggedin = 
        '<?php 
        include("conecta.php");

        $query = mysqli_query($conn, "SELECT loggedin FROM pessoas WHERE id = ".$_SESSION['id']);
        $dados = mysqli_fetch_assoc($query);

        $loggedin = $dados['loggedin'];
        $loggedin = date('i', $loggedin); 

        echo $loggedin;
        ?>';

        function time() {
            now = new Date();
            loggedtime = now.getMinutes() - 2; //2 minutos

            $.ajax({
                url: "principal.php",
                type: "POST",
                data: { data:"online" }
            })

            setTimeout("time()",30000);
        }
    </script> -->

    <?php 
    include("conecta.php");

    if(isset($_POST['data']))
    {
        $query = mysqli_query($conn, "SELECT * FROM pessoas WHERE id = '".$_SESSION['id']."'");
        $dados = mysqli_fetch_assoc($query);

        if($dados['loggedin'] != $_POST['data'])
        {
            $loggedin = time();
        
            $sql = mysqli_query($conn, "
            UPDATE pessoas 
            SET loggedin = '$loggedin'
            WHERE id = '".$_SESSION['id']."'");  
        }
    }
    mysqli_close($conn);
    ?>
</body>
</html>


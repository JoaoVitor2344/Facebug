<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Facebook 2</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css/principal.css">
    <link rel="shortcut icon" href="icone.jpg">
</head>
<body onload="time()">
    <?php include("menu.php"); ?>

    <div class="body">
        <div class="seila">
            <a>Seila</a>
            <div class="conteudo">
                <?php 
                for ($i=0; $i < 10; $i++) 
                { 
                    echo
                    '<div>
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
            $query = mysqli_query($conn, "SELECT amigos FROM pessoas WHERE id = ".$id);
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
                        $query = mysqli_query($conn, "SELECT * FROM publicações WHERE id_usu = ".$key) or die(mysqli_error($conn));

                        while ($dados = mysqli_fetch_assoc($query)) 
                        {
                            if($dados['data'] == date('Y-m-d'))
                            {
                                $datas[] = $dados['tempo'];
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
                    $query = mysqli_query($conn, "SELECT * FROM publicações WHERE id_usu = '$id'") or die(mysqli_error($conn));
                    if(mysqli_num_rows($query) > 0)
                    {
                        $query2 = mysqli_query($conn, "SELECT nome FROM pessoas WHERE id = '$id'");
                        $nome = mysqli_fetch_assoc($query2);
                        while ($dados = mysqli_fetch_assoc($query))
                        {
                            if(date('Y-m-d') == $dados['data'])
                            {
                                $data = $dados['tempo'];
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

                            echo'
                            <div class="publicação"> 
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

            <div class="outros1" id="outros1">
                <h3>Amigos</h3>
                <div class="amigos">
                    <?php 
                    include("conecta.php");

                    $id = $_SESSION['id'];
                    $query = mysqli_query($conn, "SELECT amigos FROM pessoas WHERE id = '$id'");
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
                            $id2 = $key;
                            $query2 = mysqli_query($conn, "SELECT * FROM pessoas WHERE id = '$id2'");
                            if(mysqli_num_rows($query2) > 0)
                            {
                                $dados2 = mysqli_fetch_assoc($query2);

                                $loggedin = date("i", $dados2['loggedin']);
                                $loggedtime = date("i") - 2; //2 minutos

                                if($loggedtime < $loggedin) { $status = "online"; }
                                else { $status = "offline"; }

                                echo 
                                '<div>
                                    <a href="profile.php?id='.$dados2['id'].'">
                                        <img src="usuarios/foto perfil/'.$dados2['id'].'.jpg">
                                        <a>'.$dados2['nome'].'</a>
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
            <div class="outros2" id="outros2">
            </div>
            <div class="outros3" id="outros3">
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // var status = "";
        
        // function hasNetwork(online) {
        //     if(online) { status = "online"; } 
        //     else { status = "offline"; }
        // }

        // window.addEventListener("load", () => {
        //     hasNetwork(navigator.onLine);
        //     window.addEventListener("online", () => {
        //         // Set hasNetwork to online when they change to online.
        //         hasNetwork(true);
        //     });
        //     window.addEventListener("offline", () => {
        //         // Set hasNetwork to offline when they change to offline.
        //         hasNetwork(false);
        //     });
        // });

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
    </script>

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


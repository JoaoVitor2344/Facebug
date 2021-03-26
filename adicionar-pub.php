<?php
session_start();
include("conecta.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo'); 
$data_atual = strftime('%d/%B/%Y'); 

$id = $_SESSION['id'];
$conteudo = $_POST['conteudo'];
$time = date('H:i:s');
$date = date('Y-m-d');

if($_FILES['arquivo']['size'] > 0)   
{
    $directory = "imagens/";
    $filecount = 0;
    $files = glob($directory . "*");
    if($files)
    {
        $filecount = count($files);
    }
    $id_img = $filecount + 1;

    move_uploaded_file($_FILES['arquivo']['tmp_name'], 'imagens/'.$id_img.'.jpg');
}
else
{
    $id_img = 0;
}

$sql = mysqli_query($conn, "INSERT INTO publicações(id_usu,conteudo,id_img,tempo,data) VALUES('$id','$conteudo','$id_img','$time','$date')") or die(mysqli_error($conn));

// if(!empty($conteudo))
// {
//     $url = "http://localhost/facebook2/publicações/".$id.".php";
//     $dados = file_get_contents($url);
//     $var1 = explode('<!-- -',$dados);
//     $var2 = explode('- -->',$var1[1]);

//     $val = intval($var2[0]);
//     $val2 = $val + 1;

//     $string =
// '<div class="publicação"> 
//     <div class="conteudo">
//         <span>'.strftime('%d/%B/%Y').'</span>
//         <br>
//         <a>'.$conteudo.'</a>
//     </div>
//     <div class="dropdown">
//         <button class="dropbtn">Opções</button>
//         <div class="dropdown-content">
//             <a href="excluir-pub.php?id='.$val.'">Excluir</a>
//             <a class="open-button" onclick="openForm()">Editar</a>
//         </div>
//     </div>
// </div>
// <div class="form-popup" id="myForm">
//     <form method="POST" action="editar-pub.php?id='.$val.'" class="form-container">
//         <h1>Edição</h1>
//         <label for="email"><b>Publicação</b></label>
//         <input type="text" name="conteudo" required>
//         <button type="submit" class="btn">Editar</button>
//         <button type="button" class="btn cancel" onclick="closeForm()">Cancelar</button>
//     </form>
// </div>
// <script>
//     function openForm() {
//         document.getElementById("myForm").style.display = "block";
//     }

//     function closeForm() {
//         document.getElementById("myForm").style.display = "none";
//     }
// </script>

// <!-- '.$val2.' -->
// <!-- -'.$val2.'- -->';

//     $adicionar = $var1[0] . $string;
//     $arquivo = 'publicações/'.$id.'.php';

//     file_put_contents($arquivo, $adicionar);

//     echo "<script> 
//     window.location.href = 'http://localhost/facebook2/profile.php?id=".$id."';
//     </script>";
// }
?>
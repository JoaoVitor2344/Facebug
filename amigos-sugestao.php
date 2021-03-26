<style type="text/css">
    .principal img{
        width: 100px;
        height: 100px;
    }
    .principal{
        background-color: grey;
        padding: 10px;
        display: inline-flex;
        margin-top: 10px;
    }
    .principal div{
        display: flex;
        flex-direction: column;
        margin-right: 10px;
    }
</style>

<?php 
include("menu.php");
include("conecta.php");

// Cria um array dos amigos q tem
$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT amigos FROM pessoas WHERE id = ".$id);
$dados = mysqli_fetch_assoc($query);

$amigos = $dados['amigos'];
$amigos = substr_replace($amigos, ' ', 0, 0);

for ($i=0; $i < strlen($amigos); $i++) 
{ 
    $posicao = strpos($amigos, ' ', $i);
    $amigos = substr_replace($amigos, '', $posicao, 1);

    $dados = str_split($amigos);
}

// Cria um array com todas os usuarios
$query = mysqli_query($conn, "SELECT * FROM pessoas");
while ($usuarios = mysqli_fetch_assoc($query)) 
{
    $dados2[] = $usuarios['id'];
}

//Cria um array dos diferentes elementos presentes nos outros
$dados3 = array_diff($dados2 ,$dados);

echo '<div class="principal">';

foreach ($dados3 as $key) 
{
    if($key != $id)
    {
        $query2 = mysqli_query($conn, "SELECT * FROM pessoas WHERE id = ".$key);
        $usuario = mysqli_fetch_assoc($query2);
        echo 
        '<div>
            <a href="amigos-add.php?id='.$key.'"><img src="usuarios/foto perfil/'.$key.'.jpg"><a>'.$usuario['nome'].'</a></a>
        </div>';
    }
}

echo '</div>';
mysqli_close($conn);
?>
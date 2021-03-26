<?php
if(isset($_POST['data']))
{
    include("conecta.php");
    session_start();

    $loggedtime = time() - 120; // 2 minutos

    $query = mysqli_query($conn, "SELECT loggedin FROM pessoas WHERE id = ".$_SESSION['id']);
    $dados = mysqli_fetch_assoc($query);

    if($dados['loggedin'] < $loggedtime and $_POST['data'] == "online")
    {
        $loggedin = time();

        $sql = mysqli_query($conn, "
        UPDATE pessoas 
        SET loggedin = '$loggedin'
        WHERE id = '".$_SESSION['id']."'");

        echo "online renovado";
    }

    mysqli_close($conn);
}
?>
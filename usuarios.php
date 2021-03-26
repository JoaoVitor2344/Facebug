<?php 
include("conecta.php");
$query = mysqli_query($conn, "SELECT * FROM pessoas ORDER BY id");
while($dados = mysqli_fetch_assoc($query))
{
    echo'
    			<tr>
					<th><div class="status '.$dados['loggedin'].'"></div></th>
    				<th><a href="profile.php?id='.$dados['id'].'">'.$dados['nome'].'</a></th>
    				<th><a>'.$dados['amigos'].'</a></th>
				</tr>';
}
mysqli_close($conn);
?> 
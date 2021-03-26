<?php 
$time = time();

include("conecta.php");
$query = mysqli_query($conn, "SELECT * FROM pessoas WHERE id = 1");
$dados = mysqli_fetch_assoc($query);

?>

<script type="text/javascript">
	var loggedtime = 
	'<?php 
	echo $time;
	?>';

	var loggedin = 
	'<?php
	echo $dados["loggedin"];
	?>';

	document.write(loggedtime);
	document.write("<br>");
	document.write(loggedin);
</script>
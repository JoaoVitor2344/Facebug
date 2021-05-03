<?php
$texto = $_POST['texto'];
$alfabeto = array('1' => 'a', 
				  'b', 
				  'c', 
				  'd', 
				  'e', 
				  'f', 
				  'g', 
				  'h', 
				  'i', 
				  'j', 
				  'k', 
				  'l', 
				  'm', 
				  'n', 
				  'o', 
				  'p', 
				  'q', 
				  'r', 
				  's', 
				  't', 
				  'u', 
				  'v', 
				  'w', 
				  'x', 
				  'y', 
				  'z');
$numeros = [];

for($start = 0; $start < strlen($texto); $start += 3)
{
	$n = substr($texto, $start, 2);
	array_push($numeros, $n);
}

$texto = "";

foreach($numeros as $n)
{
	if($n == '--') $texto = $texto ." "; 
	else $texto = $texto . $alfabeto[intval($n)]; 
}

echo $texto;
?>
<?php
	//Si el archivo no existe o ya esta incluido da error.
	require "Alumno.php";
	
	//Si el archivo no existe o ya esta incluido da un warning.
	//include "Alumno.php";
	
	//Si el archivo ya fue incluido no lo incluye nuevamente.
	require_once "Alumno.php";
	
	
	echo"<div style='width: 100%; line-height: 22px;'>";

	//Variable en PHP
	$nombre = "Sorullin";
	$sueldo = 10333;
	
	//Imprimir en PHP
	echo "Hola $nombre <br>";
	
	//Otra forma de imprimir en PHP
	printf("Nombre: $nombre <br>");
	printf("Sueldo: %f <br>", $sueldo);
	
	
	//Arrays en PHP.
	
	//Declaracion:
	$arraySimple = array(1,2,3);
	
	//Imprimir un array.
	var_dump($arraySimple);
	echo "<br>";
	
	//Diferentes escrituras de un array en PHP:
	$otroArray[33]="Hola";
	$otroArray[]="2018";
	$otroArray[34]="Chau";
	$otroArray["nombre"]="Maria";
	var_dump($otroArray);
	echo"</div>";
	
	
	
	//Instanciacion de un objeto en PHP:
	$elAlumno = new Alumno();
	
	//Setteo de la variable "nombre".
	$elAlumno->nombre = "Rola";
	
	$elAlumno->legajo = 768;
	$elAlumno->mail = "ASDASD@ASDASD";
	var_dump($elAlumno);
	
	echo "<br>";
?>


<html>
	<head>
	</head>

	<body>
		<span class="left">//////////</span><br>
		<span class="right">\\\\\\\\\\</span><br>
		<span class="left">//////////</span><br>
		<span class="right">\\\\\\\\\\</span><br>
		<span class="left">//////////</span><br>
		<span class="right">\\\\\\\\\\</span><br>
		<span class="left">//////////</span><br>
		<span class="right">\\\\\\\\\\</span><br>
		<span class="left">//////////</span><br>
		<span class="right">\\\\\\\\\\</span><br>
		
		<?php
		for($i=0; $i<10; $i++)
		{
			include "Repetidor.php";
		}
		?>
	</body>
</html>




<style>
body
{
	text-align: center;
	background: url("https://images7.alphacoders.com/498/thumb-1920-498256.jpg");
	 background-size: cover;
}

span
{
	font-size: 72px;
	transition: 1s; 
}

span.left:hover
{
	color: green;
	padding-top: 120px;
	padding-left: 120px;
}

span.right:hover
{
	color: red;
	padding-bottom: 120px;
	padding-right: 120px;
}
</style>
<?php
require_once("Alumno.php");

$arrayTest = array(10,8,30);
$arrayTest[] = 1000;
$arrayTest["apellido"] = "Lopez";
$arrayTest["alumno"] = new Alumno();
$arrayTest[] = new Alumno();
$arrayTest[] = "A";
$arrayTest[33] = "2";
$arrayTest[12] = "B";

var_dump($arrayTest);

echo "<br>";

sort($arrayTest);

var_dump($arrayTest);


?>
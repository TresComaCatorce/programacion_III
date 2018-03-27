<?php

require "IMostrable.php";

class Localidad implements IMostrable
{
	private $codigoPostal;
	private $nombre;

	public function Localidad($codigoPostal, $nombre)
	{
		$this->nombre = $nombre;
		$this->codigoPostal = $codigoPostal;
	}

	//Getters & Setters
	public function getCodigoPostal()
	{
		return $this->codigoPostal;
	}

	public function setCodigoPostal($codigoPostal)
	{
		$this->codigoPostal = $codigoPostal;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function MostrarHTML()
	{
		echo "getNombre() getCodigoPostal()";
	}
}

?>

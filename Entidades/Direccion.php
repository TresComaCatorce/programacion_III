<?php

require "Localidad.php";

class Direccion implements IMostrable
{
	private $calle;
	private $altura;
	private $localidad;

	public function Direccion( $calle, $altura, $localidad)
	{
		$this->calle = $calle;
		$this->altura = $altura;
		$this->localidad = $localidad;
	}


	//Getters & Setters
	public function getCalle()
	{
		return $this->calle;
	}

	public function setCalle($calle)
	{
		$this->calle = $calle;
	}

	public function getLocalidad()
	{
		return $this->localidad;
	}

	public function setLocalidad($localidad)
	{
		$this->localidad = $localidad;
	}

	public function getAltura()
	{
		return $this->altura;
	}

	public function setAltura($altura)
	{
		$this->altura = $altura;
	}

	public function MostrarHTML()
	{
		echo "getCalle() - getAltura() - getLocalidad()";
	}
}

?>

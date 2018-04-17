<?php

class alumno
{
    private $nombre;
    private $legajo;
    private $foto;

    public function setNombre( $nombre )
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setLegajo( $legajo )
    {
        $this->legajo = $legajo;
    }

    public function getLegajo()
    {
        return $this->legajo;
    }


    public function alumno( $nombre, $legajo, $foto )
    {
        $this->setNombre($nombre);
        $this->setLegajo($legajo);
        $this->setFoto($foto);
    }
}


?>
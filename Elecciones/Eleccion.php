<?php

    class Eleccion {

        public $Id;
        public $Nombre;
        public $FechaRealizacion;
        public $Estado;

        public function __construct($Id,$Nombre,$FechaRealizacion,$Estado){

            $this->Id = $Id;
            $this->Nombre=$Nombre;
            $this->FechaRealizacion=$FechaRealizacion;
            $this->Estado=$Estado;
        }
    }

?>
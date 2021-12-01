<?php

    class Puesto {

        public $Id;
        public $Nombre;
        public $Descripcion;
        public $Estado;

        public function __construct($Id,$Nombre,$Descripcion,$Estado){

            $this->Id = $Id;
            $this->Nombre=$Nombre;
            $this->Descripcion=$Descripcion;
            $this->Estado=$Estado;
        }
    }

?>
<?php

    class Partido {

        public $Id;
        public $Nombre;
        public $Descripcion;
        public $Logo;
        public $Estado;

        public function __construct($Id,$Nombre,$Descripcion,$Logo,$Estado){

            $this->Id = $Id;
            $this->Nombre=$Nombre;
            $this->Descripcion=$Descripcion;
            $this->Logo=$Logo;
            $this->Estado=$Estado;
        }
    }

?>
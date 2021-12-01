<?php

    class Ciudadano {

        public $DocId;
        public $Nombre;
        public $Apellido;
        public $Email;
        public $Estado;

        public function __construct($DocId,$Nombre,$Apellido,$Email,$Estado){

            $this->DocId = $DocId;
            $this->Nombre=$Nombre;
            $this->Apellido=$Apellido;
            $this->Email=$Email;
            $this->Estado=$Estado;
        }
    }

?>
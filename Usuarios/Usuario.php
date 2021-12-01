<?php

    class Usuario {

        public $Id;
        public $Nombre;
        public $Apellido;
        public $Email;
        public $NombreUsuario;
        public $Password;
        public $Estado;

        public function __construct($Id,$Nombre,$Apellido,$Email,$NombreUsuario,$Password,$Estado){

            $this->Id = $Id;
            $this->Nombre=$Nombre;
            $this->Apellido=$Apellido;
            $this->Email=$Email;
            $this->NombreUsuario=$NombreUsuario;
            $this->Password=$Password;
            $this->Estado=$Estado;
        }
    }

?>
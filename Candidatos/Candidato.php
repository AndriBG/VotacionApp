<?php

    class Candidato {

        public $Id;
        public $Nombre;
        public $Apellido;
        public $Estado;
        public $Partido;
        public $Puesto;
        public $Foto;

        public function __construct($Id,$Nombre,$Apellido,$Partido,$Puesto,$Foto,$Estado){

            $this->Id = $Id;
            $this->Nombre=$Nombre;
            $this->Apellido=$Apellido;
            $this->Partido=$Partido;
            $this->Puesto=$Puesto;
            $this->Foto=$Foto;
            $this->Estado=$Estado;
        }
    }

?>
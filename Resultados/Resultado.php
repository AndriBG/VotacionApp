<?php

    class Resultado {

        public $IdEleccion;
        public $IdPuesto;
        public $IdPartido;
        public $Votos;
        public $Porcentaje;

        public function __construct($IdEleccion,$IdPuesto,$IdPartido,$Votos,$Porcentaje){

            $this->IdEleccion = $IdEleccion;
            $this->IdPuesto=$IdPuesto;
            $this->IdPartido=$IdPartido;
            $this->Votos=$Votos;
            $this->Porcentaje=$Porcentaje;
        }
    }

?>
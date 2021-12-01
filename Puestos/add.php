<?php

require_once '../helpers/authAdmin.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'Puesto.php';
require_once 'ServiceDataBasePuesto.php';

$service = new ServiceDataBasePuesto();

    if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){

      

        $puesto = new Puesto(0,$_POST["nombre"],$_POST["descripcion"],true);

        $service->Add($puesto);

        header("Location: ../AdminPage/puestosElectivos.php");
        exit();
    }

?>
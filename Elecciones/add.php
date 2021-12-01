<?php

require_once '../helpers/authAdmin.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDataBaseEleccion.php';
require_once 'Eleccion.php';

$service = new ServiceDataBaseEleccion();

    if(isset($_POST["nombre"]) && isset($_POST["fecha"])){

        $eleccion = new Eleccion(0,$_POST["nombre"],$_POST["fecha"],true);

        $service->Add($eleccion);

        header("Location: ../AdminPage/elecciones.php");
        exit();
    }

?>
<?php

require_once '../helpers/authAdmin.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDataBase.php';
require_once 'Ciudadano.php';

$service = new ServiceDataBase();

    if(isset($_POST["cedula"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"])){

        $ciudadano = new Ciudadano($_POST["cedula"],$_POST["nombre"],$_POST["apellido"],$_POST["email"],true);

        $service->Add($ciudadano);

        header("Location: ../AdminPage/votantes.php");
        exit();
    }

?>
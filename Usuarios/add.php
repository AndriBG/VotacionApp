<?php

require_once '../helpers/auth.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDataBase.php';
require_once 'Usuario.php';

$service = new ServiceDataBase();

    if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){

        $puesto = new Puesto(0,$_POST["nombre"],$_POST["descripcion"],true);

        $service->Add($puesto);

        header("Location: ../../AdminPage/puestosElectivos.php");
        exit();
    }

?>
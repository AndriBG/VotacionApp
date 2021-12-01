<?php

require_once '../helpers/auth.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDataBasePartido.php';
require_once 'Partido.php';

$service = new ServiceDataBasePartido();

    if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){

        $partido = new Partido(0,$_POST["nombre"],$_POST["descripcion"],$_FILES["imagen"]["name"],true);

        if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../assets/img/profile/" . $_FILES["imagen"]["name"])){
            
        }

        $service->Add($partido);

        header("Location: ../AdminPage/partidos.php");
        exit();
    }

?>
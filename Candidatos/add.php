<?php

require_once '../helpers/authAdmin.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'Candidato.php';
require_once 'ServiceDataBaseCandidato.php';

$service = new ServiceDataBaseCandidato();

    if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["partido"]) && isset($_POST["puesto"])){

        $candidato = new Candidato(0,$_POST["nombre"],$_POST["apellido"],$_POST["partido"],$_POST["puesto"],$_FILES["imagen"]["name"],true);

        // Guarda la foto de perfil en la carpeta profile
        if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../assets/img/profile/" . $_FILES["imagen"]["name"])){
            
        }

        $service->Add($candidato);

        header("Location: ../AdminPage/candidatos.php");
        exit();
    }

?>
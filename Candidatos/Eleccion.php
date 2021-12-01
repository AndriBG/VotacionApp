<?php

    require_once '../helpers/auth.php';
    require_once '../FileHandler/FileHandlerBase.php';
    require_once "../FileHandler/CsvFileHandler.php";
    require_once "../FileHandler/JsonFileHandler.php";
    require_once '../database/EleccionesContext.php';
    require_once 'Candidato.php';
    require_once "ServiceFile.php";
    require_once 'ServiceDataBaseCandidato.php';

    $service = new ServiceDataBaseCandidato();
    $serviceFile = new ServiceFile();

    if($_GET["id"]){
        $candidato = $service->GetById($_GET["id"]);
        $serviceFile->Add($candidato);
        header("Location: ../index.php");
    }



// $service = new ServiceDataBaseCandidato();

    // if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["partido"]) && isset($_POST["puesto"])){

    //     $candidato = new Candidato(0,$_POST["nombre"],$_POST["apellido"],$_POST["partido"],$_POST["puesto"],$_FILES["imagen"]["name"],true);

    //     // Guarda la foto de perfil en la carpeta profile
    //     if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../assets/img/profile/" . $_FILES["imagen"]["name"])){
            
    //     }

    //     $service->Add($candidato);

    //     header("Location: ../AdminPage/candidatos.php");
    //     exit();
    // }

?>
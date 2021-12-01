<?php

  require_once 'Puesto.php';
  require_once '../FileHandler/FileHandlerBase.php';
  require_once '../FileHandler/JsonFileHandler.php';
  require_once '../database/EleccionesContext.php';
  require_once 'ServiceDataBase.php';

  $service = new ServiceDataBase();

      $containId = isset($_GET["id"]);

      if($containId){
         $service->Delete($_GET["id"]);
     }

     header("Location: puestosElectivos.php");
     exit();
?>
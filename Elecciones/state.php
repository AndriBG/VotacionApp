<?php

require_once '../helpers/authAdmin.php';
require_once 'Eleccion.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDataBaseEleccion.php';

$service = new ServiceDataBaseEleccion();

if (isset($_GET["id"])) {
    $service->Change($_GET["id"]);
}

header("Location: ../AdminPage/elecciones.php");
exit();

?>
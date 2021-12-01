<?php

require_once '../helpers/authAdmin.php';
require_once "../helpers/utilities.php";
require_once '../Elecciones/Eleccion.php';
require_once 'Ciudadano.php';
require_once '../Layout/adminLayout.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once "../Elecciones/ServiceDataBaseEleccion.php";
require_once 'ServiceDataBase.php';

$utilities = new Utilities();
$serviceEleccion = new ServiceDataBaseEleccion(); // objeto de elecciones
$layout = new Layout();
$service = new ServiceDatabase();

$Elecciones = $serviceEleccion->GetList();
$IsActive = $utilities->isActive($Elecciones); // Devuelve true si hay una elección activa, sino false.

$ciudadano = null;

if (isset($_GET["id"])) {

    $ciudadano = $service->GetById($_GET["id"]);
}

if (isset($_POST["cedula"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"])) {

    $status = ($_POST["estado"] == "Activo") ? true : false;

    $pue = $service->GetById($_POST["cedula"]);

    if($IsActive){
        $status = $pue->Estado;
    }

    $ciudadano = new Ciudadano($_POST["cedula"],$_POST["nombre"],$_POST["apellido"],$_POST["email"], $status);

    $service->Edit($ciudadano);

    header("Location: ../AdminPage/votantes.php");
}



?>

    <?php echo $layout->printHeader() ?>

    <?php if ($ciudadano == null) : ?>
        <h2>No existe este votante</h2>
    <?php else : ?>

        <form action="edit.php" method="POST">

            <input type="hidden" name="cedula" value="<?= $ciudadano->DocId ?>">

            <div class="mb-3">
                <label for="hero-name" class="form-label">Nombre</label>
                <input name="nombre" value="<?php echo $ciudadano->Nombre ?>" type="text" class="form-control" id="hero-name">
            </div>

            <div class="mb-3">
                <label for="hero-name" class="form-label">Apellido</label>
                <input name="apellido" value="<?php echo $ciudadano->Apellido ?>" type="text" class="form-control" id="hero-name">
            </div>
                <div class="mb-3">
                <label for="hero-name" class="form-label">Email</label>
                <input name="email" value="<?php echo $ciudadano->Email ?>" type="text" class="form-control" id="hero-name">
            </div>

            <div class="mb-3">
                <p>Estado</p>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($ciudadano->Estado==1): ?>  checked
                            <?php endif; ?> class="form-check-input" <?php if($IsActive): ?> disabled <?php endif; ?> type="radio" value="Activo" name="estado" id="activo"/>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($ciudadano->Estado==0): ?>  checked
                            <?php endif; ?> class="form-check-input" <?php if($IsActive): ?> disabled <?php endif; ?> type="radio" value="Inactivo" name="estado" id="inactivo"/>
                            <label class="form-check-label" for="inactivo">Inactivo</label>
                        </div>
            </div>

            <a href="../AdminPage/adminIndex.php" class="btn btn-warning">Volver atras </a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>


    <?php echo $layout->printFooter() ?>

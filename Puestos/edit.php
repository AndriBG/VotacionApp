<?php

require_once '../helpers/authAdmin.php';
require_once "../helpers/utilities.php";
require_once 'Puesto.php';
require_once '../Elecciones/Eleccion.php';
require_once "../Candidatos/Candidato.php";
require_once '../Layout/adminLayout.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../Candidatos/ServiceDataBaseCandidato.php';
require_once '../Elecciones/ServiceDataBaseEleccion.php';
require_once 'ServiceDataBasePuesto.php';

$serviceEleccion = new ServiceDataBaseEleccion(); // objeto de elecciones
$layout = new Layout();
$utilities = new Utilities();
$service = new ServiceDataBasePuesto();
$serviceCandidato = new ServiceDataBaseCandidato();

$candidatos = $serviceCandidato->GetList();
$puesto = null;

$Elecciones = $serviceEleccion->GetList();
$IsActive = $utilities->isActive($Elecciones); // Devuelve true si hay una elección activa, sino false.

if (isset($_GET["id"])) {
    $puesto = $service->GetById($_GET["id"]);
}

if (isset($_POST["Nombre"]) && isset($_POST["Descripcion"])) {

    $status = ($_POST["Estado"] == "Activo") ? true : false;

    $pue = $service->GetById($_POST["Id"]);

    if($IsActive){
        $status = $pue->Estado;
    }

    $puesto = new Puesto($_POST["Id"],$_POST["Nombre"], $_POST["Descripcion"], $status);

    $service->Edit($puesto);

    // -----------------------------------
    $Puestos = $service->GetList();

        // Inactiva todos los candidatos que pertenezca a un puesto inactivo.
        foreach($Puestos as $puesto){
            if($puesto->Estado==0){
                foreach($candidatos as $candidato){
                    if($candidato->Puesto==$puesto->Id){
                        $serviceCandidato->Change($puesto->Id);
                    }
                }
            }
        }
    // --------------------------------------

    header("Location: ../AdminPage/puestosElectivos.php");
}


?>

    <?php echo $layout->printHeader() ?>

    <?php if ($puesto == null) : ?>
        <h2>No existe este puesto</h2>
    <?php else : ?>

        <form action="edit.php" method="POST">

            <input type="hidden" name="Id" value="<?= $puesto->Id ?>">

            <div class="mb-3">
                <label for="hero-name" class="form-label">Nombre</label>
                <input name="Nombre" value="<?= $puesto->Nombre ?>" type="text" class="form-control" id="hero-name">

            </div>

            <div class="mb-3">
                <label for="puesto-description" class="form-label">Descripcion</label>
                        <textarea name="Descripcion" type="text" class="form-control" id="puesto-description" rows="3"><?= $puesto->Descripcion; ?></textarea>
            </div>

            <div class="mb-3">
                <p>Estado</p>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($puesto->Estado==1): ?>  checked
                            <?php endif; ?> <?php if($IsActive): ?> disabled <?php endif; ?>class="form-check-input" type="radio" value="Activo" name="Estado" id="activo"/>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($puesto->Estado==0): ?>  checked
                            <?php endif; ?> <?php if($IsActive): ?> disabled <?php endif; ?> class="form-check-input" type="radio" value="Inactivo" name="Estado" id="inactivo"/>
                            <label class="form-check-label" for="inactivo">Inactivo</label>
                        </div>
            </div>

            <a href="../AdminPage/puestosElectivos.php" class="btn btn-warning">Volver atras</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>

    <?php echo $layout->printFooter() ?>
<?php

require_once '../helpers/authAdmin.php';
require_once "../helpers/utilities.php";
require_once 'Partido.php';
require_once "../Candidatos/Candidato.php";
require_once '../Elecciones/Eleccion.php';
require_once '../Layout/adminLayout.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../Candidatos/ServiceDataBaseCandidato.php';
require_once '../Elecciones/ServiceDataBaseEleccion.php';
require_once 'ServiceDataBasePartido.php';


$serviceEleccion = new ServiceDataBaseEleccion(); // objeto de elecciones
$layout = new Layout();
$utilities = new Utilities();
$service = new ServiceDataBasePartido();
$serviceCandidato = new ServiceDataBaseCandidato();

$candidatos = $serviceCandidato->GetList();

$partido = null;

$Elecciones = $serviceEleccion->GetList();
$IsActive = $utilities->isActive($Elecciones); // Devuelve true si hay una elección activa, sino false.

if (isset($_GET["id"])) {
    $partido = $service->GetById($_GET["id"]);
}

if (isset($_POST["Nombre"]) && isset($_POST["Descripcion"])) {

    $status = ($_POST["Estado"] == "Activo") ? true : false;
       
    $pue = $service->GetById($_POST["Id"]);

    if($IsActive){
        $status = $pue->Estado;
    }

    if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../assets/img/profile/" . $_FILES["imagen"]["name"])){
            
    }

    $partido = new Partido($_POST["Id"],$_POST["Nombre"], $_POST["Descripcion"], $_FILES["imagen"]["name"], $status);

    $service->Edit($partido);

        // -----------------------------------
        $Partidos = $service->GetList();

        // Inactiva todos los candidatos que pertenezca a un partido inactivo.
        foreach($Partidos as $partido){
            if($partido->Estado==0){
                foreach($candidatos as $candidato){
                    if($candidato->Partido==$partido->Id){
                        $serviceCandidato->Change($partido->Id);
                    }
                }
            }
        }
    // --------------------------------------

    header("Location: ../AdminPage/partidos.php");
}


?>

    <?php echo $layout->printHeader() ?>

    <?php if ($partido == null) : ?>
        <h2>No existe este partido</h2>
    <?php else : ?>

        <form action="edit.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="Id" value="<?= $partido->Id ?>">

            <div class="mb-3">
                <label for="hero-name" class="form-label">Nombre</label>
                <input name="Nombre" required value="<?= $partido->Nombre ?>" type="text" class="form-control" id="hero-name">

            </div>

            <div class="mb-3">
                <label for="puesto-description" class="form-label">Descripcion</label>
                        <textarea name="Descripcion" required type="text" class="form-control" id="puesto-description" rows="3"><?= $partido->Descripcion; ?></textarea>
            </div>

            <div class="mb-3">
                <p>Estado</p>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($partido->Estado==1): ?>  checked
                            <?php endif; ?> class="form-check-input" <?php if($IsActive): ?> disabled <?php endif; ?> type="radio" value="Activo" name="Estado" id="activo"/>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($partido->Estado==0): ?>  checked
                            <?php endif; ?> class="form-check-input" <?php if($IsActive): ?> disabled <?php endif; ?> type="radio" value="Inactivo" name="Estado" id="inactivo"/>
                            <label class="form-check-label" for="inactivo">Inactivo</label>
                        </div>
            </div>

            <div class="mb-3">
                            <label for="partido-foto" class="form-label">Foto:</label>
                            <input name="imagen" required type="file" accept=".jpg, .png" class="form-control" id="partido-foto">
            </div>

            <a href="../AdminPage/partidos.php" class="btn btn-warning">Volver atras</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>




    <?php echo $layout->printFooter() ?>

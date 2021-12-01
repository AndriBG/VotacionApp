<?php

    require_once '../helpers/authAdmin.php';
    require_once "../helpers/utilities.php";
    require_once 'Candidato.php';
    require_once '../Elecciones/Eleccion.php';
    require_once '../Partidos/Partido.php';
    require_once '../Puestos/Puesto.php';
    require_once '../Layout/adminLayout.php';
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once 'ServiceDataBaseCandidato.php';
    require_once "../Elecciones/ServiceDataBaseEleccion.php";
    require_once '../Partidos/ServiceDataBasePartido.php';
    require_once '../Puestos/ServiceDataBasePuesto.php';

    $layout = new Layout();
    $serviceEleccion = new ServiceDataBaseEleccion(); // objeto de elecciones
    $service = new ServiceDataBaseCandidato();
    $utilities = new Utilities();
    $servicePartido  = new ServiceDataBasePartido();
    $servicePuesto = new ServiceDataBasePuesto();

    $candidato = null;

    $Puestos = $servicePuesto->GetList();
    $Partidos = $servicePartido->GetList();

    $Elecciones = $serviceEleccion->GetList();
    $IsActive = $utilities->isActive($Elecciones); // Devuelve true si hay una elección activa, sino false.

    if (isset($_GET["id"])) {
        $candidato = $service->GetById($_GET["id"]);
    }

    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["partido"]) && isset($_POST["puesto"])) {

        $status = ($_POST["estado"] == "Activo") ? true : false;

        $pue = $service->GetById($_POST["Id"]);

        if($IsActive){
            $status = $pue->Estado;
        }

        if(move_uploaded_file($_FILES["imagen"]["tmp_name"],"../assets/img/profile/" . $_FILES["imagen"]["name"])){
            
        }

        $candidato = new Candidato($_POST["Id"],$_POST["nombre"],$_POST["apellido"],$_POST["partido"],$_POST["puesto"],$_FILES["imagen"]["name"], $status);

        $service->Edit($candidato);

        header("Location: ../AdminPage/candidatos.php");
    }

?>

    <?php echo $layout->printHeader() ?>

    <?php if ($candidato == null) : ?>
        <h2>No existe este candidato</h2>
    <?php else : ?>

        <form action="edit.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="Id" value="<?= $candidato->Id ?>">

            <div class="mb-3">
                <label for="hero-name" class="form-label">Nombre</label>
                <input name="nombre" value="<?php echo $candidato->Nombre ?>" type="text" class="form-control" id="hero-name">
            </div>

            <div class="mb-3">
                <label for="hero-name" class="form-label">Apellido</label>
                <input name="apellido" value="<?php echo $candidato->Apellido ?>" type="text" class="form-control" id="hero-name">
            </div>

            <div class="mb-3">
                <label for="student-photo" class="form-label">Elija una foto</label>
                <input name="imagen" required accept="image/png, image/jpeg" type="file"  class="form-control" id="student-photo">
            </div>

            <div class="mb-3 col-md-4">
                <label for="career" class="form-label">Puestos</label>
                <select name="puesto" class="form-select" id="career">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($Puestos as $puesto) : ?>

                        <?php if ($puesto->Id == $candidato->Puesto) : ?>
                            <option selected value="<?= $puesto->Id ?>"> <?= $puesto->Nombre ?> </option>
                        <?php else : ?>
                            <option value="<?= $puesto->Id; ?>"> <?= $puesto->Nombre ?> </option>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3 col-md-4">
                <label for="career" class="form-label">Partidos</label>
                <select name="partido" class="form-select" id="career">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($Partidos as $partido) : ?>
                        
                        <?php if ($partido->Id == $candidato->Partido) : ?>
                            <option selected value="<?= $partido->Id; ?>"> <?= $partido->Nombre ?> </option>
                        <?php else : ?>
                            <option value="<?= $partido->Id; ?>"> <?= $partido->Nombre ?> </option>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <p>Estado</p>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($candidato->Estado==1): ?>  checked
                            <?php endif; ?> class="form-check-input" <?php if($IsActive): ?> disabled <?php endif; ?> type="radio" value="Activo" name="estado" id="activo"/>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input 
                            <?php if($candidato->Estado==0): ?>  checked
                            <?php endif; ?> class="form-check-input" <?php if($IsActive): ?> disabled <?php endif; ?> type="radio" value="Inactivo" name="estado" id="inactivo"/>
                            <label class="form-check-label" for="inactivo">Inactivo</label>
                        </div>
            </div>

            <a href="../AdminPage/candidatos.php" class="btn btn-warning">Volver al Listado</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>


    <?php echo $layout->printFooter() ?>

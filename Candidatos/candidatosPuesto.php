<?php

    require_once "../helpers/auth.php";
    require_once "../layout/layout.php";
    require_once "Candidato.php";
    require_once "../Puestos/Puesto.php";
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../FileHandler/CsvFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once "../Puestos/ServiceDataBasePuesto.php";
    require_once "ServiceDataBaseCandidato.php";

    $ServiceCandidato = new ServiceDataBaseCandidato();
    $ServicePuesto = new ServiceDataBasePuesto();
    $layout = new Layout();
    
    $candidatos = array();

    if($_GET["id"]){
        $candidatos = $ServiceCandidato->GetListCandPuesto($_GET["id"]);
    }

?>

<?php echo $layout->printHeader (); ?>

<div class="container mb-4 text-center">
    <h3 class="text-white">Candidatos Disponibles Para <?= $ServicePuesto->GetNameById($_GET["id"]); ?>s</h3>
</div>

<div class="row p-5">
    <?php foreach ( $candidatos as $candidato ) : ?>
        <div class="col-md-4 candidato mx-4 p-3" data-id="<?= $candidato->Id; ?>">
            <div class="card">
                <div class="card-body">
                        <img class="card-img" src="../assets/img/profile/<?= $candidato->Foto; ?>"/>
                        <hr/>
                        <p class="card-text"><b><?= $candidato->Nombre ." ". $candidato->Apellido ?>.</b></p>
                </div>
            </div>
        </div>
    <?php  endforeach; ?>
</div>

<div class="d-grid">
    <button class="btn btn-success btn-lg" id="votar">Elegir</button>
</div>

<?php echo $layout->printFooter (); ?>

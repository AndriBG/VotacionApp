<?php

    // require_once "Elecciones/Eleccion.php";
    // require_once "helpers/utilities.php";

    require_once "Ciudadanos/Ciudadano.php";
    require_once "Puestos/Puesto.php";
    require_once "Candidatos/Candidato.php";
    require_once 'FileHandler/FileHandlerBase.php';
    require_once 'FileHandler/JsonFileHandler.php';
    require_once "database/EleccionesContext.php";
    require_once "Ciudadanos/ServiceDataBase.php";
    require_once "Puestos/ServiceDataBasePuesto.php";
    require_once "Candidatos/ServiceDataBaseCandidato.php";
    // require_once "Elecciones/ServiceDataBaseEleccion.php";
    require_once "Layout/layout.php";

    $service = new ServiceDataBase(true);
    $serviceCandidato = new ServiceDataBaseCandidato(true);
    $servicePuesto = new ServiceDataBasePuesto(true);
    $layout = new Layout(true);
    // $serviceEleccion = new ServiceDataBaseEleccion(true);
    // $utilities = new Utilities();

    // $Elecciones = $serviceEleccion->GetList();
    $message = "";
    $messageAuth = "";
    $Puestos = $servicePuesto->GetList();
    $Candidatos = $serviceCandidato->GetList();

    session_start();

    // si un administrador logueado intenta entrar, que lo mande al index del administrador(Backoffice); 
    if(isset($_SESSION["admin"])){
        header("Location: AdminPage/adminIndex.php");
        exit();
    }

    // si está seteada y es diferente de null, el logueo es correcto.
    $isLogger = (isset($_SESSION["user"]) && $_SESSION["user"] != null) ? true : false;

    if(!$isLogger){
        header("Location: login/Login.php");
    }

?>

<?php echo $layout->printHeader(); ?>

<!-- !---------------! -->

    <br>

    <div class="row p-2">
        <?php foreach ($Puestos as $puesto ) : ?>
            <?php if($puesto->Estado==1): ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="Candidatos/candidatosPuesto.php?id=<?= $puesto->Id ?>" class="card-text"><b>Mostrar <?= $puesto->Nombre ?>s</b></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>     
        <?php endforeach; ?>
        <div class="mt-3"><button class="btn btn-info">Votar</button></div>
    </div>


<!-- !---------------! -->

<?php echo $layout->printFooter (); ?>

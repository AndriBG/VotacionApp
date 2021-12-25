<?php

    require_once "../helpers/authAdmin.php";
    require_once "../helpers/utilities.php";
    require_once "../Layout/adminLayout.php";
    require_once "../Elecciones/Eleccion.php";
    require_once "../Candidatos/Candidato.php";
    require_once "../Elecciones/ServiceDataBaseEleccion.php";
    require_once "../Candidatos/ServiceDataBaseCandidato.php";
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    // require_once "../Puestos/ServiceDataBasePuesto.php";

    $layout = new Layout();
    $service = new ServiceDataBaseEleccion();
    $serviceCandidato = new ServiceDataBaseCandidato();
    $utilities = new Utilities();

    $Elecciones = $service->GetList();
    $Candidatos = $serviceCandidato->GetList();

    $isThere = $utilities->isActive($Elecciones);

    // Saber cuantos candidatos hay activos
    $contador = 0;
    foreach($Candidatos as $can){
        if($can->Estado==1){
            $contador++;
        }
    }

?>

<?php echo $layout->printHeader (); ?>

    <div class="row">
        <div class="col-md-8">
            <h2 class="text-white">Listado de Elecciones</h2>
        </div>
        <div class="col-md-4">
        <?php if($contador>=2): ?>
            <?php if(!$isThere): ?>
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal-eleccion">Iniciar Elección</button>
            <?php endif; ?>
        <?php else: ?>
                <div class="alert alert-danger">Debe haber al menos dos candidatos Activos para iniciar una elección.</div>
        <?php endif; ?>
        </div>
    </div> 
        <hr  />
    <?php if(count($Elecciones)==0):?> 
        <h2>No hay Elecciones</h2>
    <?php else : ?>
            <table class="bg-light table table-striped table-hover">
            <thead>
                <tr>
                <th>Nombre</th>
                <th>Fecha De Realización</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Elecciones as $eleccion): ?>
                    <?php if($eleccion->Estado!=1) :?> <!-- Si no hay una elección activa -->
                        <tr>
                            <td><?= $eleccion->Nombre; ?></td>
                            <td><?= $eleccion->FechaRealizacion; ?></td>
                            <td><a href="../Resultados/Resultado.php?id=<?= $eleccion->Id; ?>" class="btn btn-danger">Ver Resultados</a></td>
                        </tr>
                    <?php else: ?>
                        <tr class="bg-success">
                            <td><?= $eleccion->Nombre; ?></td>
                            <td><?= $eleccion->FechaRealizacion; ?></td>
                            <td><a href="../Elecciones/state.php?id=<?= $eleccion->Id; ?>" class="btn btn-warning">Finalizar</a></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach;?>
            </tbody>
            </table>
    <?php endif; ?>

<!-- MODAL -->
    <div class="modal" id="modal-eleccion" tabindex="-1" aria-labelledby="modal-puestos-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-puestos-label">Nueva Elección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Elecciones/add.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="puesto-nombre">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="puesto_nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="fec">Fecha:</label>
                            <input type="date" name="fecha" min="2021-04-26" step="1" />
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="estado" id="CBX_Estado" value="activo" checked disabled>Estado
                            <div id="textHelp" class="form-text">Esta opción se genera como "activo" por defecto.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php echo $layout->printFooter (); ?>
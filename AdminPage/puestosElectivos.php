<?php

    require_once "../helpers/authAdmin.php";
    require_once "../Layout/adminLayout.php";
    require_once "../Puestos/Puesto.php";
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once "../Puestos/ServiceDataBasePuesto.php";

    $service = new ServiceDataBasePuesto();
    $puestos = $service->GetList();
    $layout = new Layout();

?>

<?php echo $layout->printHeader (); ?>
    <div class="row">
        <div class="col-md-10">
            <h2 class="">Listado de Puestos</h2>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal-nuevo-puesto">Nuevo Puesto</button>
        </div>
    </div> <!-- Estos son los cargos mínimos que se deben crear de manera predeterminada: Presidente, Alcalde, Senador y Diputado -->
        <hr  />
    <?php if(count($puestos)==0):?> <!-- Tengo estos valores del PHP comentados solo para poder establecer la estructura y no generen errores -->
        <h2>No hay puestos electivos alguno agregado.</h2>
    <?php else : ?>
    <div class="row">
    <?php foreach ( $puestos as $puesto ) : ?>
            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><b>Nombre: </b><?= $puesto->Nombre ?></h6>
                        <p class="card-text"> <b>Descripción: </b><?= $puesto->Descripcion ?></p>
                        <?php if($puesto->Estado==1): ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-success">Activo</span></p>
                        <?php else: ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-danger">Inactivo</span></p>
                        <?php endif; ?>
                        <a href="../Puestos/edit.php?id=<?= $puesto->Id ?>" class="btn btn-success">Editar</a>      
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

<!-- MODAL -->

    <div class="modal" id="modal-nuevo-puesto" tabindex="-1" aria-labelledby="modal-puestos-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-puestos-label">Nuevo Puesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Puestos/add.php" method="POST"> <!-- Se tendrá que trabajar esta parte para arreglaro bien, solo he colocado los inputs -->
                        <div class="mb-3">
                            <label class="form-label" for="puesto-nombre">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="INP_Nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="puesto-descripcion">Descripción:</label>
                            <textarea type="text" name="descripcion" class="form-control" id="INP_Descripcion"></textarea>
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
        <br  /><br  />
<?php echo $layout->printFooter (); ?>
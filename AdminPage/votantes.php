<?php

    require_once "../Layout/adminLayout.php";
    require_once "../helpers/authAdmin.php";
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once "../Ciudadanos/Ciudadano.php";
    require_once "../Ciudadanos/ServiceDataBase.php";

    $service = new ServiceDataBase();
    $votantes = $service->GetList();
    $layout = new Layout();


?>
<?php echo $layout->printHeader (); ?>

<div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal-nuevo-votante">Nuevo Votante</button>
        </div>
    </div>
        <hr  />
    <?php if ( count ( $votantes ) == 0 ) : ?>
        <h2>No hay votante alguno agregado.</h2>
    <?php else : ?>
        <div class="row">
        <?php foreach ( $votantes as $votante ) :  ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">Cédula: <?= $votante->DocId ?>.</p>
                        <p class="card-text">Nombre: <?= $votante->Nombre ." ". $votante->Apellido; ?>.</p>
                        <p class="card-text">Email: <?= $votante->Email ?>.</p>
                        <?php if($votante->Estado==1): ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-success">Activo</span></p>
                        <?php else: ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-danger">Inactivo</span></p>
                        <?php endif; ?>
                        <a href="../Ciudadanos/edit.php?id=<?= $votante->DocId ?>" class="btn btn-success">Editar</a>
                    </div>
                </div>
            </div>
        <?php  endforeach; ?>
        </div>
    <?php  endif; ?>
    

    <!-- MODAL -->

    <div class="modal" id="modal-nuevo-votante" tabindex="-1" aria-labelledby="modal-votantes-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-votantes-label">Nuevo Votante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Ciudadanos/add.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="votante-identidad">Documento de Identidad:</label>
                            <input type="text" name="cedula" class="form-control" id="votante-identidad">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="votante-nombre">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="votante-nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="votante-apellido">Apellido:</label>
                            <input type="text" name="apellido" class="form-control" id="votante-apellido"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="votante-apellido">Email:</label>
                            <input type="email" name="email" class="form-control" id="votante-apellido"></input>
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
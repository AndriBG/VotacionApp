<?php

    require_once "../helpers/authAdmin.php";
    require_once "../Layout/adminLayout.php";
    require_once "../Partidos/Partido.php";
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once "../Partidos/ServiceDataBasePartido.php";

    $service = new ServiceDataBasePartido();
    $partidos = $service->GetList();
    $layout = new Layout();

?>

<?php echo $layout->printHeader (); ?>

    <div class="row">
        <div class="col-md-10">
            <h2 class="">Listado de Partidos</h2>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal-nuevo-partido">Nuevo Partido</button>
        </div>
    </div>

        <hr  />
    <?php if(count( $partidos ) == 0 ): ?> <!-- Tengo estos valores del PHP comentados solo para poder establecer la estructura y no generen errores -->
        <h2>No hay partido alguno agregado.</h2>
    <?php  else : ?>
        <div class="row">
        <?php foreach ( $partidos as $partido ) : ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img" src="../assets/img/profile/<?= $partido->Logo; ?>"  />
                            <hr  />
                  
                        <p class="card-text">Nombre: <?= $partido->Nombre ?>.</p>
                        <p class="card-text">Descripción: <?= $partido->Descripcion ?>.</p>
                        <?php if($partido->Estado==1): ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-success">Activo</span></p>
                        <?php else: ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-danger">Inactivo</span></p>
                        <?php endif; ?>
                        <a href="../Partidos/edit.php?id=<?= $partido->Id ?>" class="btn btn-success">Editar</a>
                    </div>
                </div>
            </div>
        <?php  endforeach; ?>
        </div>
    <?php  endif; ?>



<!-- MODAL -->

    <div class="modal" id="modal-nuevo-partido" tabindex="-1" aria-labelledby="modal-partidos-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-partidos-label">Nuevo Partido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Partidos/add.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="partido-foto" class="form-label">Foto:</label>
                            <input name="imagen" type="file" accept=".jpg, .png" class="form-control" id="partido-foto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="partido-nombre">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="partido-nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="partido-descripcion">Descripción:</label>
                            <textarea type="text" name="descripcion" class="form-control" id="partido-descripcion"></textarea>
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
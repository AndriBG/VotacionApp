<?php

    require_once "../helpers/authAdmin.php";
    require_once "../Layout/adminLayout.php";
    require_once "../Candidatos/Candidato.php";
    require_once "../Puestos/Puesto.php";
    require_once "../Partidos/Partido.php";
    require_once "../helpers/utilities.php";
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once "../Candidatos/ServiceDataBaseCandidato.php";
    require_once "../Puestos/ServiceDataBasePuesto.php";
    require_once "../Partidos/ServiceDataBasePartido.php";


    $service = new ServiceDataBaseCandidato();
    $servicePuesto = new ServiceDataBasePuesto();
    $servicePartido = new ServiceDataBasePartido();
    $layout = new Layout();
    $utilities = new Utilities();

    $candidatos = $service->GetList();
    $Puestos = $servicePuesto->GetList();
    $Partidos = $servicePartido->GetList();
    $pu = $utilities->isActive($Puestos);
    $pa = $utilities->isActive($Partidos);


?>

<?php echo $layout->printHeader (); ?>

    <div class="row">
        <div class="col-md-7">
            <h2 class="">Listado de Candidatos</h2>
        </div>
        <div class="col-md-5">
        <?php if($pa && $pu): ?>
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal-candidato">Crear Candidato</button>
        <?php else: ?>
                <div class="alert alert-danger">Debe haber al menos un partido y un puesto creado y activo para agregar candidatos.</div>
        <?php endif; ?>
        </div>
    </div>

        <hr  />
    <?php if(count( $candidatos ) == 0 ): ?>
        <h2>No hay candidato alguno agregado.</h2>
    <?php  else : ?>
        <div class="row">
        <?php foreach ( $candidatos as $candidato ) : ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img" src="../assets/img/profile/<?= $candidato->Foto; ?>"  />
                        <hr/>
                        <p class="card-text">Nombre: <?= $candidato->Nombre ." ". $candidato->Apellido ?>.</p>

                        <p class="card-text">Partido: <?= $servicePartido->GetNameById($candidato->Partido); ?>.</p>
            
                        <p class="card-text">Puesto: <?= $servicePuesto->GetNameById($candidato->Puesto); ?>.</p>

                        <?php if($candidato->Estado==1): ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-success">Activo</span></p>
                        <?php else: ?>
                            <p class="card-text"> <b>Estado: </b><span class="text-danger">Inactivo</span></p>
                        <?php endif; ?>
                        <a href="../Candidatos/edit.php?id=<?= $candidato->Id ?>" class="btn btn-success">Editar</a>
                    </div>
                </div>
            </div>
        <?php  endforeach; ?>
        </div>
    <?php  endif; ?>

<!-- MODAL -->

    <div class="modal" id="modal-candidato" tabindex="-1" aria-labelledby="modal-partidos-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-partidos-label">Nuevo Candidato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../Candidatos/add.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="partido-foto" class="form-label">Foto:</label>
                            <input name="imagen" required type="file" accept=".jpg, .png" class="form-control" id="partido-foto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="partido-nombre">Nombre:</label>
                            <input type="text" required name="nombre" class="form-control" id="partido-nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="partido-nombre">Apellido:</label>
                            <input type="text" required name="apellido" class="form-control" id="partido-nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="partido-nombre">Puestos:</label>
                            <select name="puesto" required class="form-select" id="career">
                                <option value="">Seleccione un Puesto</option>
                                <?php foreach ($Puestos as $puesto) : ?>
                                    <option value="<?= $puesto->Id; ?>"> <?= $puesto->Nombre ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="partido-nombre">Partidos:</label>
                            <select name="partido" required class="form-select" id="career">
                                <option value="">Seleccione un Partido</option>
                                <?php foreach ($Partidos as $partido) : ?>
                                    <option value="<?= $partido->Id; ?>"> <?= $partido->Nombre ?> </option>
                                <?php endforeach; ?>
                            </select>
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
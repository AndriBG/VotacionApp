<?php

require_once "../Layout/layout.php";
require_once "../Elecciones/Eleccion.php";
require_once "../helpers/utilities.php";
require_once '../Ciudadanos/Ciudadano.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once "../Ciudadanos/ServiceDataBase.php";
require_once "../Elecciones/ServiceDataBaseEleccion.php";

session_start();

if(isset($_SESSION["user"])){
    header("Location: ../index.php");
}

$serviceEleccion = new ServiceDataBaseEleccion();
$layout = new Layout();
$service = new ServiceDataBase();
$utilities = new Utilities();

$Elecciones = $serviceEleccion->GetList();
$Ciudadanos = $service->GetList();

$message = "";
$messageEleccion = "";

if(isset($_POST["cedula"]) && $_POST["cedula"] != ""){

    $result = $service->GetById($_POST["cedula"]);

    if($result==null){
        $message = "Datos erróneos. Por favor, inténtelo otra vez.";
    } else {
        
        // Si hay un usuario activo entra
        if($result->Estado==true){

            $Active = $utilities->isActive($Elecciones);

            if($Active){
                $_SESSION["user"] = $result;
                header("Location: ../index.php");

            } else {
                $messageEleccion = "No hay una Elección Activa";
            }

        } else {
            $messageEleccion = "Este usuario está inactivo";
        }
    }
}

?>

<?php echo $layout->printHeader(); ?>

<?php if($messageEleccion!=""): ?>
    <div class="alert alert-danger">
        <?= $messageEleccion; ?>
    </div>
<?php endif; ?>

<div class="row h-100">

    <div class="col-8 d-flex align-items-center">
            <h2 class="titulo animate__animated animate__pulse animate__infinite infinite">Sistema de Votaciones R.D. 2021</h2>
    </div>
    <div class="col-4 login">
        <form action="Login.php" method="POST">
            <h3 class="modal-title text-white">Login</h3>
                <br  />
                    <?php if($message!=""): ?>
                        <div class="alert alert-danger">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>
            <div class="mb-3">
                <label for="estudiante-foto" class="form-label text-white">No. de cédula:</label>
                <input type="text" required name="cedula" class="form-control" id="INP_Cedula">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Ingresar</button>
            </div>
        </form>
    </div>

</div>

<?php echo $layout->printFooter (); ?>
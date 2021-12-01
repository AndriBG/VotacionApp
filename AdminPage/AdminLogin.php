<?php

    require_once "../Layout/loginLayout.php";
    require_once '../Usuarios/Usuario.php';
    require_once '../FileHandler/FileHandlerBase.php';
    require_once '../FileHandler/JsonFileHandler.php';
    require_once '../database/EleccionesContext.php';
    require_once "../Usuarios/ServiceDataBase.php";
    
    session_start();

    if(isset($_SESSION["admin"])){
        header("Location: adminIndex.php");
    }

    $layout = new Layout();
    $service = new ServiceDataBase();

    $message = "";

    if(isset($_POST["usu"]) && isset($_POST["contra"])){

        $result = $service->Login($_POST["usu"],$_POST["contra"]);

        if($result==null){
            $message = "Usuario o contraseña incorrecto. Inténtelo de nuevo.";
        } else {
            $_SESSION["admin"] = $result;
            header("Location: adminIndex.php");
        }
    }


?>

<?php echo $layout->printHeader(); ?>

<div class="row h-100">

    <div class="col-8 d-flex align-items-center">
            <h2 class="titulo animate__animated animate__pulse animate__infinite infinite">Sistema de Votaciones R.D. 2021</h2>
    </div>
    <div class="col-4 login">
        <form action="AdminLogin.php" method="POST">
            <h3 class="modal-title text-white">Login Admin</h3>
                <br  />
                    <?php if($message!=""): ?>
                        <div class="alert alert-danger">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>
            <div class="mb-3">
                <label for="usu" class="form-label text-white">Usuario:</label>
                <input type="text" required name="usu" class="form-control" id="usu">
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label text-white">Contraseña:</label>
                <input type="password" required name="contra" class="form-control" id="contra">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Iniciar Sesión</button>
            </div>
        </form>
    </div>

</div>


<?php echo $layout->printFooter(); ?>
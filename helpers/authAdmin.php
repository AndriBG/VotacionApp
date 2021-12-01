<?php
    session_start();

     // si hay una sesión iniciada como user, entra
     if(isset($_SESSION["admin"])){

        // si hay una sesión user pero es null
        if($_SESSION["admin"] == null){
            $_SESSION["messageAuth"] = "Debes Iniciar Sesión";
            header("Location: ../AdminPage/AdminLogin.php");
            exit();
        }

    // si no hay una sesión user entra aquí
    } else {
        $_SESSION["messageAuth"] = "Debes Iniciar Sesión";
        header("Location: ../AdminPage/AdminLogin.php");
        exit();
    }

?>
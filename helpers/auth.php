<?php

    session_start();

    // si hay una sesión iniciada como user, entra
    if(isset($_SESSION["user"])){

        // si hay una sesión user pero es null
        if($_SESSION["user"] == null){
            $_SESSION["messageAuth"] = "Debes Iniciar Sesión";
            header("Location: ../Index.php");
            exit();
        }

    // si no hay una sesión user entra aquí
    } else {
        $_SESSION["messageAuth"] = "Debes Iniciar Sesión";
        header("Location: ../Index.php");
        exit();
    }

?>
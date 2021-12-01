<?php

    require_once "../Layout/adminLayout.php";
    require_once "../helpers/authAdmin.php";

    // session_start();

    $layout = new Layout();

?>
<?php echo $layout->printHeader (); ?>

    <h1 class="text-white">Página Inicial</h1>

<?php echo $layout->printFooter (); ?>
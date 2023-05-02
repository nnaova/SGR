<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {

    if (isset($_POST['id_b'])) {
        $id_boisson = $_POST['id_b'];
        $statmt = $pdo->prepare('delete from plat where `id_plat`=' . $id_boisson . ';');
        $statmt->execute();
        header('location: /SGRC/index.php?page=boisson');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}

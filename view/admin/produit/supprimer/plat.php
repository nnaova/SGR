<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {

    if (isset($_POST['id_pl'])) {
        $id_plat = $_POST['id_pl'];
        $statmt = $pdo->prepare('delete from plat where `id_plat`=' . $id_plat . ';');
        $statmt->execute();
        header('location: /SGRC/index.php?page=plat');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}

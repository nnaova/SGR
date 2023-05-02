<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {
    //connexion a la base de données
    include "../../../php/connexion.php";

    if (isset($_GET['id_u'])) {
        $id_user = $_GET['id_u'];
        $statmt = $pdo->prepare('delete from user where `id_user`=' . $id_user . ';');
        $statmt->execute();
        header('location: utilisateur.php');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}
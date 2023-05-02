<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {

if (isset($_POST['id_m'])) {
    $id_menu = $_POST['id_m'];
    $statmt = $pdo->prepare("DELETE FROM menu_contient_plat WHERE id_menu = :id_menu");
    $statmt->bindParam(":id_menu",$id_menu,PDO::PARAM_INT);
    $statmt->execute();
    $statmt = $pdo->prepare("DELETE FROM menu WHERE `id_menu`= :id_menu ;");
    $statmt->bindParam(':id_menu',$id_menu,PDO::PARAM_INT);
    $statmt->execute();
    header('location: /SGRC/index.php?page=menu');
}
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}

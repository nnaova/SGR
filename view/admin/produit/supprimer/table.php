<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {
    if (isset($_POST['id_t'])) {
        $id_table = $_POST['id_t'];
        $statmt = $pdo->prepare('delete from sgr_table where `id_table`=' . $id_table . ';');
        $statmt->execute();
        header('location: /SGRC/index.php?page=table');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}

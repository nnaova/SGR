<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/SGRC/css/style_admin/produit/edition-ajoute.css" rel="stylesheet">
        <title>Ajout Table</title>
    </head>

    <body>
        <div class="right">
            <div class="theme-toggler" id="theme-toggler">
                <!-- Dark and Light -->
                <i class="fa-solid fa-circle-half-stroke"></i>
            </div>
        </div>
        <form action="" method="POST" id="ValidationDuFormulaireTable">
            <a href="?page=table" class="back_btn">Retour</a>
            <h2>Ajouter une table </h2>
            <!-- <label for="id_table">Identifiant</label> -->
            <input name="id_table" id="id_table" type="hidden">
            <!-- Le numero de la table -->
            <label for="numero_table">Numero de la table</label>
            <input name="numero_table" id="numero_table" autofocus="autofocus" type="number"> <br>
            <!-- Le type de table -->
            <label for="type_table">Type de table</label>
            <select name="type_table" id="type_table">
                <option value="CAR">CAR</option>
                <option value="RON">RON</option>
            </select> <br>
            <!--visible-->
            <label for="vu">visible/invisible</label>
            <select name="vu" id="vu">
                <option value="0">visible</option>
                <option value="1">invisible</option>
            </select>
            <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter"> <br>


            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJS -->
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-table.js"></script>

    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}
?>
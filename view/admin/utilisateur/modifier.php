<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {
    include "../../../php/connexion.php";

    $id_u = $_GET['id_u'];
    $Requete_edit_user = "SELECT * FROM `user` WHERE id_user = " . $id_u . "";
    $re = $pdo->query($Requete_edit_user);
    $user = $re->fetchALL(PDO::FETCH_ASSOC);

    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/SGRC/css/style_admin/produit/edition-ajoute.css" rel="stylesheet">
        <title>Modification utilisateur</title>
    </head>

    <body>
        <div class="right">
            <div class="theme-toggler" id="theme-toggler">
                <!-- Dark and Light -->
                <i class="fa-solid fa-circle-half-stroke active"></i>
            </div>
        </div>
        <form action="#" method="POST" id="ValidationDuFormulaireUtilisateur">
            <a href="utilisateur.php" class="back_btn"> Retour</a>
            <h2>Modifier l'utilisateur</h2>
            <input name="id_user" id="id_user" type="hidden" value=<?php echo htmlspecialchars(($user[0]['id_user'])) ?>>
            <!-- Login -->
            <label for="login">Login</label>
            <input name="login" id="login" type="text" value="<?php echo htmlspecialchars(($user[0]['login'])) ?>"> <br>
            <!--Rôle -->
            <label for="role">Rôle</label>
            <input name="role" id="role" type="text" value="<?php echo htmlspecialchars(($user[0]['role'])) ?>"> <br>
            <!-- Le prix unitaire du menu -->
            <label for="mdp">Mot de passe</label>
            <input name="mdp" id="mdp" type="password"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Modifier">

            <?php
            if (isset($_POST['Validez'])) {
                // Variable des éléments
                $id_u = htmlspecialchars($_POST['id_user']);
                $login = htmlspecialchars($_POST['login']);
                $role = htmlspecialchars($_POST['role']);
                $mdp = htmlspecialchars($_POST['mdp']);
                // Variable de id_user en GET
                $id_u = $_GET['id_u'];

                $reqUP = "UPDATE user SET login='$login',role='$role',mdp='$mdp' WHERE id_user ='$id_u'";
                $resulat = mysqli_query($link, $reqUP);
                header('location: utilisateur.php');
            }
            ?> <br>
            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script Dark mode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJs -->
        <script src="/SGRC/js/admin/utilisateur/verification_utilisateur_s_ajax.js"></script>
    </body>

    </html>
    <?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}
?>
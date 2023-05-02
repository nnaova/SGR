<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Utilisateur</title>
        <!-- Lien CSS -->
        <link rel="stylesheet" href="/SGRC/css/style_admin/utilisateur/utilisateur.css" />
        <link rel="stylesheet" href="/SGRC/css/style_admin/tableau_de_bord/tableau_de_bord.css" />
    </head>

    <body>
        <!-- Conteneur -->
        <div class="container">
            <aside>
                <!-- MENU (logo & titre & bouton fermer) -->
                <div class="top">
                    <div class="logo">
                        <img src="/SGRC/image/img/source/logo.png" alt="logo du site" />
                        <h2>La table <span class="primary">d'Hélène</span></h2>
                    </div>
                    <div class="close" id="close-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="sidebar">
                    <!-- Tableau de bord -->
                    <a href="?page=tableau">
                        <i class="fa-solid fa-house"></i>
                        <h3>Tableau de bord</h3>
                    </a>
                    <!-- Tables -->
                    <a href="?page=table">
                        <i class="fa-solid fa-list-check"></i>
                        <h3>Tables</h3>
                    </a>
                    <!-- Plats -->
                    <a href="?page=plat">
                        <i class="fa-solid fa-list-check"></i>
                        <h3>Plats</h3>
                    </a>
                    <!-- Boissons -->
                    <a href="?page=boisson">
                        <i class="fa-solid fa-list-check"></i>
                        <h3>Boissons</h3>
                    </a>
                    <!-- Menus -->
                    <a href="?page=menu">
                        <i class="fa-solid fa-list-check"></i>
                        <h3>Menus</h3>
                    </a>
                    <!-- Utilisateurs -->
                    <a href="?page=users" class="active">
                        <i class="fa-solid fa-user"></i>
                        <h3>Utilisateurs</h3>
                    </a>
                    <!-- Categorie -->
                    <a href="?page=categorie">
                        <i class="fa-solid fa-user"></i>
                        <h3>Categorie</h3>
                    </a>
                    <!-- Deconnexion-->
                    <a href="/SGRC/php/deconnexion.php">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <h3>Deconnexion</h3>
                    </a>
                </div>
            </aside>
            <!-------------Fin ASIDE  ----------------->
        <main>
            <h1>Les utilisateur</h1>

            <div class="Utilisateur">
                <!-- Table -->
                    <table class="table-grid">
                        <caption>
                            Les utilisateur
                        </caption>
                        <thead>
                            <tr>
                                <th>Login</th>
                                <th>Rôle</th>
                                <th>Mot de passe</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php
                        foreach ($users as $user) {
                            ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $user['login']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['role']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['mdp']; ?>
                                    </td>
                                    <td>
                                        <!-- Supprimer -->
                                        <a href="supprimer.php?id_u=<?php echo $user['id_user']; ?>"
                                            onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                        <!-- Modifier -->
                                        <a href="modifier.php?id_u=<?php echo $user['id_user']; ?>"><i
                                                class="fa-solid fa-file-pen"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                        <!-- Ligne ajout -->
                        <tr class="add">
                            <td colspan="4">
                                <a href="/SGRC/view/admin/utilisateur/ajouter.php">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </main>
            <!-- Fin du  main -->
            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="theme-toggler" id="theme-toggler">
                        <!-- Dark and Light -->
                        <i class="fa-solid fa-circle-half-stroke active"></i>
                    </div>
                    <div class="profil">
                        <div class="info">
                            <br>
                            <p style="text-transform: uppercase;"><b>
                                    <?php echo $_SESSION['role'] ?>
                                </b></p>

                        </div>
                        <?php
                        $sql_req = "SELECT * FROM user WHERE id_user =" . $_SESSION['id_user'];
                        $stt = $pdo->prepare($sql_req);
                        $stt->execute();
                        $row = $stt->fetch();
                        ?>
                        <div class="profil-photot">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script Menu -->
        <script src="/SGRC/js/source/menu.js"></script>
        <!-- Script Dark Mode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
    </body>

    </html>
    <?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}
?>
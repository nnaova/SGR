<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "admin") {
    //include "include/connexion.php";
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Categorie</title>
        <!-- Lien CSS -->
        <link rel="stylesheet" href="/SGRC/css/style_admin/produit/produit.css" />
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
                    <a href="?page=users">
                        <i class="fa-solid fa-user"></i>
                        <h3>Utilisateurs</h3>
                    </a>
                    <!-- Categorie -->
                    <a href="?page=categorie" class="active">
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
            <h1>Categorie</h1>
            <?php
            // Code PHP à insérer ici si nécessaire
            ?>
            <div class="Produits">
                <!-- Tableau -->
                    <table class="table-grid">
                        <caption>
                            Ordre d'affichage
                        </caption>
                        <thead>
                            <tr>
                                <th>Nom Categorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        // Boucle sur chaque catégorie
                        foreach ($categories as $categorie) {
                            ?>
                            <tbody>
                                <tr>
                                    <!-- Affichage du nom de la catégorie -->
                                    <td>
                                        <?php echo $categorie['nom_cat']; ?>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <!-- Formulaire pour afficher les sous-catégories -->
                                                    <form method="post" action="?page=sous_categorie">
                                                        <input type="hidden" name="action" value="sous_categorie">
                                                        <input type="hidden" name="id_t"
                                                            value="<?php echo $categorie['id_cat']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primmary"><i
                                                                class="fa-solid fa-folder-open"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Formulaire pour modifier la catégorie -->
                                                    <form action="?page=modif_categorie" method="post">
                                                        <input type="hidden" name="action" value="modif cat">
                                                        <input type="hidden" name="id_t"
                                                            value="<?php echo $categorie['id_cat']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primary"><i
                                                                class="fa-solid fa-file-pen"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Formulaire pour supprimer la catégorie -->
                                                    <form method="post" action="?page=suppr_cat">
                                                        <input type="hidden" name="action" value="suppr cat">
                                                        <input type="hidden" name="id_t"
                                                            value="<?php echo $categorie['id_cat']; ?>">
                                                        <button type="submit"
                                                            onclick="return confirm ('êtes-vous sûr de vouloir supprimer ?')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Formulaire pour monter la catégorie dans l'ordre d'affichage -->
                                                    <form method="post">
                                                        <input type="hidden" name="action" value="monter ordre cat">
                                                        <input type="hidden" name="id_c"
                                                            value="<?php echo $categorie['id_cat']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primmary"><i
                                                                class="fa-solid fa-arrow-up"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Formulaire pour descendre la catégorie dans l'ordre d'affichage -->
                                                    <form method="post">
                                                        <input type="hidden" name="action" value="descendre ordre cat">
                                                        <input type="hidden" name="id_c"
                                                            value="<?php echo $categorie['id_cat']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primmary"><i
                                                                class="fa-solid fa-arrow-down"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                        <!-- Ligne ajout -->
                        <tr class="add">
                            <td colspan="4">
                                <a href="?page=ajout_categorie">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!-- END Produits -->
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
                            <!-- <small class="text-muted">Admin</small> -->
                        </div>
                        <?php
                        $sql_req = "SELECT * FROM user WHERE id_user = " . $_SESSION['id_user'];
                        $statm = $pdo->prepare($sql_req);
                        $statm->execute();
                        $row = $statm->fetch();
                        ?>
                        <div class="profil-photot">
                            <!-- <img src="/SGRC/php/images/<?php echo $row['image']; ?>" alt=""> -->
                            <!-- <img src="/SGRC/image/img/source/profil.jpg" alt="Profil" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Script Dark Mode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- Script Menu -->
        <script src="/SGRC/js/source/menu.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location:../../../index.php");
    exit();
}
?>
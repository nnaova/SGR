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
        <title>Produit</title>
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
                    <!-- Produits -->
                    <a href="?page=produit" class="active">
                        <i class="fa-solid fa-list-check"></i>
                        <h3>Produits</h3>
                    </a>
                    <!-- Utilisateurs -->
                    <a href="?page=users">
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
            <h1>Produits</h1>
            <div class="Produits">
                <!-- Table -->
                    <table class="table-grid">
                        <caption>
                            Les table
                        </caption>
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Type de table</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($tables as $table) {
                            ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $table['numero_table']; ?>
                                    </td>
                                    <td>
                                        <?php echo $table['type_table']; ?>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <!-- Supprimer -->
                                                    <form method="post" action="?page=suppr_table">
                                                        <input type="hidden" name="action" value="suppr table">
                                                        <input type="hidden" name="id_t"
                                                            value="<?php echo $table['id_table']; ?>">
                                                        <button type="submit"
                                                            onclick="return confirm ('êtes-vous sûr de vouloir supprimer ?')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Modifier -->
                                                    <form method="post" action="?page=modif_table">
                                                        <input type="hidden" name="action" value="modif table">
                                                        <input type="hidden" name="id_t"
                                                            value="<?php echo $table['id_table']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primmary"><i
                                                                class="fa-solid fa-file-pen"></i></button>
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
                                <a href="?page=ajout_table">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>

                    <!-- Les plat -->
                    <table class="table-grid">
                        <caption>
                            Les plats
                        </caption>
                        <thead>
                            <tr>
                                <th>Nom du plat</th>
                                <th>Description</th>
                                <th>Type de plat</th>
                                <th>Prix à la carte</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($plats as $plat) {
                            ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $plat['nom_plat']; ?>
                                    </td>
                                    <td class="description-text">
                                        <?php echo $plat['description']; ?>
                                    </td>
                                    <td>
                                        <?php echo $plat['nom_sous_cat']; ?>
                                    </td>
                                    <td>
                                        <?php echo $plat['PU_carte']; ?>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <!-- Supprimer -->
                                                    <form method="post" action="?page=suppr_plat">
                                                        <input type="hidden" name="action" value="suppr plat">
                                                        <input type="hidden" name="id_pl"
                                                            value="<?php echo $plat['id_plat']; ?>">
                                                        <button type="submit"
                                                            onclick="return confirm('êtes-vous sûr de vouloir supprimer')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Modifier -->
                                                    <form method="post" action="?page=modif_plat">
                                                        <input type="hidden" name="action" value="modif plat">
                                                        <input type="hidden" name="id_pl"
                                                            value="<?php echo $plat['id_plat']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primary"><i
                                                                class="fa-solid fa-file-pen"></i></button>
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
                            <td colspan="5">
                                <a href="?page=ajout_plat">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!-- Les boissons -->
                    <table class="table-grid">
                        <caption>
                            Les boissons
                        </caption>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Type de boisson</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        foreach ($boissons as $boisson) {
                            ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $boisson['nom_plat']; ?>
                                    </td>
                                    <td class="description-text">
                                        <?php echo $boisson['description']; ?>
                                    </td>
                                    <td>
                                        <?php echo $boisson['nom_sous_cat']; ?>
                                    </td>
                                    <td>
                                        <?php echo $boisson['PU_carte']; ?>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <!-- Supprimer -->
                                                    <form method="post" action="?page=suppr_boisson">
                                                        <input type="hidden" name="action" value="suppr boisson">
                                                        <input type="hidden" name="id_b"
                                                            value="<?php echo $boisson['id_plat']; ?>">
                                                        <button type="submit"
                                                            onclick="return confirm ('êtes-vous sûr de vouloir supprimmer')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!--modifier-->
                                                    <form method="post" action="?page=modif_boisson">
                                                        <input type="hidden" name="action" value="modif boisson">
                                                        <input type="hidden" name="id_b"
                                                            value="<?php echo $boisson['id_plat']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primary"><i
                                                                class="fa-solid fa-file-pen"></i></button>
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
                                <a href="?page=ajout_boisson">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!--menu-->
                    <table class="table-grid">
                        <caption>
                            Menu
                        </caption>
                        <thread>
                            <tr>
                                <th>nom</th>
                                <th>date</th>
                                <th>description</th>
                                <th>prix</th>
                                <th>action</th>
                            </tr>
                        </thread>
                        <?php
                        foreach ($menus as $menu) {
                            ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $menu['nom_menu']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $date_array = explode("-", $menu['date_menu']);
                                        $date_menu = $date_array[2] . "/" . $date_array[1] . "/" . $date_array[0];
                                        echo $date_menu; ?>
                                    </td>
                                    <td class="description-text">
                                        <?php echo $menu['description']; ?>
                                    </td>
                                    <td>
                                        <?php echo $menu['PU']; ?>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <!--supprimer-->
                                                    <form method="post" action="?page=suppr_menu">
                                                        <input type="hidden" name="action" value="suppr menu">
                                                        <input type="hidden" name="id_m"
                                                            value="<?php echo $menu['id_menu']; ?>">
                                                        <button type="submit"
                                                            onclick="return confirm ('êtes-vous sûr de vouloir supprimmer ?')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!--modifier-->
                                                    <form action="?page=modif_menu" method="post">
                                                        <input type="hidden" name="action" value="modif menu">
                                                        <input type="hidden" name="id_m"
                                                            value="<?php echo $menu['id_menu']; ?>">
                                                        <button type="submit" value="modifier" class="btn btn-primary"><i
                                                                class="fa-solid fa-file-pen"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!--menu contient plat-->
                                                    <form method="post" action="?page=carte_menu">
                                                        <input type="hidden" name="action" value="carte menu">
                                                        <input type="hidden" name="id_m"
                                                            value="<?php echo $menu['id_menu']; ?>">
                                                        <button type="submit" value="carte" class="btn btn-primary"><i
                                                                class="fa-solid fa-gears"></i></button>
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
                                <a href="?page=ajout_menu">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
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
                        </div>
                        <?php
                        $sql_req = "SELECT * FROM user WHERE id_user = " . $_SESSION['id_user'];
                        $statm = $pdo->prepare($sql_req);
                        $statm->execute();
                        $row = $statm->fetch();
                        ?>
                        <div class="profil-photot">
                            <?php echo $row['image']; ?>
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
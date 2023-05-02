<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SGRC/css/style_service/prise_de_commande.css">
    <title>Prendre une commande</title>
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
                <!-- Commander -->
                <a href="#" class="active">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <h3>Commande</h3>
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
            <div class="numero_table">
                <h1 class="titre">Choisir une table</h1>
                <form method="post">
                    <input type="hidden" name="action" value="choix_table">
                    <?php
                    foreach ($tables as $table) {
                        ?>
                    <input Type='submit' id='<?php echo $table['id_table']; ?>' name='numero_table_voulue'
                        value="<?php echo $table['numero_table']; ?>">

                    <?php
                    }
                    ?>
                </form>
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
                        <p>Bonjour, <b>service</b></p>
                        <small class="text-muted">Admin</small>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Bouton des table -->






    <!-- Script DarkMode -->
    <script src="/SGRC/js/source/dark_mode.js"></script>
    <!-- SCRIPT FONT AWESOME -->
    <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    <script src="/SGRC/js/source/menu.js"></script>
</body>

</html>
<?php
if ($_SESSION["role"] == "admin") {
    
    
    
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Tableau de bord</title>
        <!-- Lien CSS -->
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
                    <a href="?page=tableau" class="active">
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
                <h1>Tableau de bord</h1>


                <div class="statistical">
                    <!-- tl-commande -->
                    <div class="tl-commande">
                        <i class="fa-solid fa-magnifying-glass-chart"></i>
                        <!-- middle -->
                        <div class="middle">
                            <div class="left">
                                <h3>Total des commandes</h3>
                                <h1><?php echo $nbtickets['nb_tickets']?></h1>
                            </div>
                            
                        </div>
                    </div>
                    <!------------Fin statistical commande -------->

                    
                    <!-- tl-connexion -->
                    <div class="tl-connexion">
                        <i class="fa-solid fa-chart-bar"></i>
                        <!-- middle -->
                        <div class="middle">
                            <div class="left">
                                <h3>Utilisateurs</h3>
                                <h1><?php echo $nbusers['nb_users'] ?></h1>
                            </div>
                        </div>
                    </div>
                    <!------------Fin statistical Total de connexion  -------->

                    
                </div>
                <div class="Commande-rencent">
                    <h2>Commandes récentes</h2>



                    <table>
                        <thead>
                            <th>Numéro de ticket</th>
                            <th>Numéro de table</th>
                            <th>Statut</th>
                            <th>Date de commande</th>
                            <th>Heure</th>
                            <th>Prix</th>
                        </thead>

                        <?php
                        
                        
                        foreach ($sumtickets as $sumticket) {
                            $idticket_caisse = $sumticket['id_ticket'];
                            $statmt20->execute();
                            $prixticket = $statmt20->fetch(PDO::FETCH_ASSOC);

                            $statmt24->execute();
                            $date_heure_T = $statmt24->fetch(PDO::FETCH_ASSOC);

                        ?>

                                                <!-- Couleurs des lignes selon statut -->
                        <tbody>
                            <?php
                            if($sumticket['statut'] == 'PAY'){?>
                                <tr>
                                    <td class="success"><?php echo  " # " . "\n" . $sumticket['id_ticket'] ?></td>
                                    <td class="success"><?php echo  " n° " . "\n" . $sumticket['numero_table'] ?></td>
                                    <td class="success"><?php echo  " " . "\n" . $sumticket['statut'] ?></td>
                                    <td class="success"><?php echo $date_heure_T['D'] ?></td>
                                    <td class="success"><?php echo $date_heure_T['H'] ?></td>
                                    <td class="success"><?php echo  " " . "\n" . number_format($prixticket['TT'], 2);?> €</td>
                                </tr>
                            <?php
                            }
                            elseif($sumticket['statut'] == 'VAL'){?>
                            <tr>
                                <td class="warning"><?php echo  " # " . "\n" . $sumticket['id_ticket'] ?></td>
                                <td class="warning"><?php echo  " n° " . "\n" . $sumticket['numero_table'] ?></td>
                                <td class="warning"><?php echo  " " . "\n" . $sumticket['statut'] ?></td>
                                <td class="warning"><?php echo $date_heure_T['D'] ?></td>
                                <td class="warning"><?php echo $date_heure_T['H'] ?></td>
                                <td class="warning"><?php echo  " " . "\n" . number_format($prixticket['TT'], 2);?> €</td>
                            </tr>
                        
                            <?php }

                        else {?>
                                <tr>
                                    <td class="danger"><?php echo  " # " . "\n" . $sumticket['id_ticket'] ?></td>
                                    <td class="danger"><?php echo  " n° " . "\n" . $sumticket['numero_table'] ?></td>
                                    <td class="danger"><?php echo  " " . "\n" . $sumticket['statut'] ?></td>
                                    <td class="danger"><?php echo $date_heure_T['D'] ?></td>
                                    <td class="danger"><?php echo $date_heure_T['H'] ?></td>
                                    <td class="danger"><?php echo  " " . "\n" . number_format($prixticket['TT'], 2);?> €</td>
                                </tr>
                           <?php }?>
                            
                            
                            <!-- Ligne 1 -->
                            
                            
                        </tbody>
                        <?php }?>
                    </table>

                    
                    
                    <a href="#">Afficher tout</a>
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
                            <p style="text-transform: uppercase;"><b><?php echo $_SESSION['role'] ?></b></p>
                        </div>
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM user WHERE id_user = {$_SESSION['id_user']}");
                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_assoc($sql);
                        }
                        ?>
                        <div class="profil-photot">
                            
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
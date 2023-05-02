<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["role"] == "service") {
    $Table_selec = $_SESSION['tables'];
    // Code pour afficher le nombre de couvert
    $idTable = $_SESSION['idT'];

    $recupTicket = $pdo->prepare('SELECT id_ticket FROM ticket where id_table = :idTable order by id_ticket DESC LIMIT 1');
    $recupTicket->bindParam(":idTable", $idTable, PDO::PARAM_INT);
    $recupTicket->execute();
    $idTicket = $recupTicket->fetch();

    //Récup nombre de couvert
    $recupNbc = $pdo->prepare('SELECT nb_couvert FROM ticket WHERE id_ticket = :idT');
    $recupNbc->bindParam(':idT', $idTicket['id_ticket'], PDO::PARAM_INT);
    $recupNbc->execute();
    $nb_couverts_recup = $recupNbc->fetch();

    //recup quantiter
    $recupQtePlat = $pdo->prepare('SELECT quantite FROM `ligne_ticket` WHERE id_ticket = :idT and id_plat = :idP');
    $recupQtePlat->bindParam(':idT', $idTicket['id_ticket'], PDO::PARAM_INT);
    $recupQtePlat->bindParam('idP', $idP, PDO::PARAM_INT);

    //Récup des plats des sous catégories
    $statmt30 = $pdo->prepare('SELECT P.* FROM menu M, plat P, menu_contient_plat MP,sous_categorie SC WHERE P.id_plat=MP.id_plat AND M.id_menu=MP.id_menu and P.id_sous_cat=SC.id_sous_cat and P.id_sous_cat = :id_sous_cat and P.vu = 0 and M.date_menu = CURDATE()'); /*  */
    $statmt30->bindParam(':id_sous_cat', $sous_cat, PDO::PARAM_INT);

    //Récup des sous catégories des catégories
    $statmt29 = $pdo->prepare('SELECT * FROM sous_categorie inner join plat on plat.id_sous_cat = sous_categorie.id_sous_cat where id_cat = :idcat AND (SELECT COUNT(P.id_plat) FROM menu M, plat P, menu_contient_plat MP,sous_categorie SC WHERE P.id_plat=MP.id_plat AND M.id_menu=MP.id_menu and P.id_sous_cat=SC.id_sous_cat and P.id_sous_cat = :idsouscat and P.vu = 0 and M.date_menu = CURDATE()) is not null GROUP BY nom_sous_cat ORDER BY ordre_aff_sous_cat'); /*  */
    $statmt29->bindParam(':idcat', $cat, PDO::PARAM_INT);
    $statmt29->bindParam(':idsouscat', $sous_cat, PDO::PARAM_INT);
    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/SGRC/css/style_service/plat.css">
        <title>Plat a prendre</title>
        <!-- BOXICONS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    </head>

    <body>
        <div class="texte1">
            <p> Table sélectionné :
                <?php echo $Table_selec ?>
            </p>
            <form>
                <input type="hidden" name="action" value="oublier_table">
                <input type="hidden" name="id_t" value="<?php echo $idTicket['id_ticket']; ?>">
                <input type="submit">
            </form>
        </div>
        <p class="texte2"> Nombre de couvert :
            <?php echo $nb_couverts_recup['nb_couvert'] ?> &nbsp; <a
                href="view/service/prise_de_commande/nbCouvert_Modif.php"><i class="fa-solid fa-pen-to-square"></i></a>
        </p>
        <p class="texte3"> numero du ticket :
            <?php echo $_SESSION['id_ticket']; ?>
        </p>
        <div class="plat">
            <div class="container">
                <div class="tabs">
                    <?php
                    $statmt28->execute();
                    $categories = $statmt28->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $categorie) {
                        $cat = $categorie['id_cat'];
                        ?>
                        <button class="tab-button" id="tab-button-<?php echo $cat; ?>"><?php echo $categorie['nom_cat']; ?></button>
                        <?php
                    } ?>
                </div>
                <?php
                $statmt28->execute();
                $categories = $statmt28->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $categorie) {
                    $cat = $categorie['id_cat'];
                    ?>
                    <div class="tab-content" id="tab-content-<?php echo $cat; ?>">
                        <?php

                        $statmt29->execute();
                        $souscats = $statmt29->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($souscats as $souscat) {
                            $sous_cat = $souscat['id_sous_cat'];
                            $statmt30->execute();
                            $plats = $statmt30->fetchAll(PDO::FETCH_ASSOC);
                            echo $souscat['nom_sous_cat']; ?><table border="0">
                                <?php
                                foreach ($plats as $plat) {
                                    $id_p = $plat['id_plat']; ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $plat['nom_plat']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $plat['description']; ?>
                                        </td>
                                        <td>
                                            <!-- boutons + -->
                                            <form method="POST">
                                                <input type="hidden" name="action" value="cree_ligne_ticket">
                                                <input type="hidden" name="id_plat" value="<?php echo $id_p; ?>">
                                                <input type="hidden" name="id_ticket" value="<?php echo $idTicket['id_ticket']; ?>">
                                                <input type="number" name="nb_plat"
                                                    value="<?php echo $nb_couverts_recup['nb_couvert']; ?>">
                                                <input type="submit" value="+" id="plus">
                                            </form>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                        <?php }
                        ?>
                    </div>
                    <?php
                } ?>

                <?php
                $idTicket = $_SESSION['id_ticket'];
                $statmt31->execute();
                $mes_lignes_tickets = $statmt31->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <br>
                <br>
                <br>


            </div>
        </div>
        <div class="ticket_de_caisse">
            <table>
                <?php

                //affichage des LDT
                foreach ($mes_lignes_tickets as $ma_ligne) {

                    ?>
                    <div class="container_ticket">
                        <tr>
                            <td class="titre">
                                <?php echo $ma_ligne['nom_plat']; ?>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="text" name="commentaire" size="15"
                                        value="<?php echo (($ma_ligne['commentaire'] != NULL) ? $ma_ligne['commentaire'] : ''); ?>">
                            </td>
                            <td>
                                <input type="submit" value="modifier" class="btn_modifier">
                                <input type="hidden" name="action" value="modifier_commentaire">
                                <input type="hidden" name="id_ligne_ticket" value="<?php echo $ma_ligne['id_ligne_ticket']; ?>">
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="submit" value="supprimer" class="btn_supprimer">
                                    <input type="hidden" name="action" value="supprimer_ligne_ticket">
                                    <input type="hidden" name="id_ligne_ticket"
                                        value="<?php echo $ma_ligne['id_ligne_ticket']; ?>">
                                </form>
                            </td>
                        </tr>
                    </div>
                    <?php
                }
                ?>
            </table>
        </div>

        <div class="right">
            <div class="theme-toggler" id="theme-toggler">
                <!-- Dark and Light -->
                <i class="fa-solid fa-circle-half-stroke"></i>
            </div>
        </div>



        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>

    </body>

    <script>
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        function handleTabButtonClick(event) {
            // Masquer tous les contenus d'onglet
            tabContents.forEach(tabContent => {
                tabContent.style.display = 'none';
            });

            // Afficher le contenu de l'onglet sélectionné
            const tabContentId = event.target.id.replace('tab-button-', 'tab-content-');
            document.getElementById(tabContentId).style.display = 'block';
        }

        // Ajouter un gestionnaire d'événement de clic sur chaque bouton d'onglet
        tabButtons.forEach(tabButton => {
            tabButton.addEventListener('click', handleTabButtonClick);
        });

        // Afficher le premier contenu d'onglet par défaut
        tabContents[1].style.display = 'block';
    </script>

    </html>
    <?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /SGRC/index.php");
    exit();
}
?>
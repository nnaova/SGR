<?php

// Le load_ticket sert a actualiser les l'affichage des ticket dans caisse.
// Si modif dans caisse.php ou historique.php, bien faire les changement dans ce fichier

session_start();
include "../../include/connexion.php";
// recup de la liste des tickets non payé
$statmt16 = $pdo->prepare('SELECT * FROM ticket,sgr_table WHERE statut != "PAY" AND ticket.id_table = sgr_table.id_table');
$statmt16->execute();
$ticketsBar = $statmt16->fetchAll(PDO::FETCH_ASSOC);

// recup de la liste des tickets payé (pour l'historique)
$statmt185 = $pdo->prepare('SELECT * FROM ticket,sgr_table WHERE statut = "PAY" AND ticket.id_table = sgr_table.id_table ORDER BY ticket.id_ticket DESC');
$statmt185->execute();
$ticketsBar2 = $statmt185->fetchAll(PDO::FETCH_ASSOC);

// recup nom plat / quantite / prix unitaire
$statmt17 = $pdo->prepare('SELECT DISTINCT ticket.id_ticket, plat.nom_plat, COUNT(nom_plat) AS quantité ,ligne_ticket.commentaire, (plat.PU_carte * COUNT(nom_plat)) as prix FROM ligne_ticket, plat, ticket, sous_categorie, categorie_plat WHERE ticket.id_ticket = :id_ticket and ticket.id_ticket = ligne_ticket.id_ticket and plat.id_plat=ligne_ticket.id_plat and plat.id_sous_cat = sous_categorie.id_sous_cat and sous_categorie.id_cat = categorie_plat.id_cat GROUP BY nom_plat ORDER BY ordre_affichage_cat, ordre_aff_sous_cat');
$statmt17->bindParam(':id_ticket', $idticket_caisse, PDO::PARAM_INT);

//recup le prix total du ticket
$statmt20 = $pdo->prepare('SELECT sum(plat.PU_carte) as TT FROM ligne_ticket, plat, ticket WHERE ligne_ticket.id_ticket = ticket.id_ticket AND ligne_ticket.id_plat = plat.id_plat AND ticket.id_ticket = :id_ticket ');
$statmt20->bindParam(':id_ticket', $idticket_caisse, PDO::PARAM_INT);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Ticket cuisine -->
    <div class="card_ticket">

        <?php
        foreach ($ticketsBar as $ticketBar) {
        ?>
            <div class="ticket">

                <table>
                    <caption>
                        <?php
                        echo  "Table n° :" . "\n" . $ticketBar['numero_table'] . '<br/>'; 
                        echo "N° Ticket : #";
                        $numTicket = $ticketBar['id_ticket'];
                        while (strlen($numTicket) < 3) {
                            $numTicket = '0' . $numTicket;
                        }
                        echo $numTicket;
                        ?>

                    </caption>
                    <thead>
                        <tr>
                            <th>Quantite</th>
                            <th>Nom Boissons</th>
                            <th>Prix</th>
                        </tr>
                    </thead>

                    <?php
                    $idticket_caisse = $ticketBar['id_ticket'];
                    $statmt17->execute();
                    $commandes = $statmt17->fetchAll();
                    $statmt20->execute();
                    $prixTT = $statmt20->fetch(PDO::FETCH_ASSOC);

                    foreach ($commandes as $commande) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $commande['quantité']; ?> </td>
                                <td><?php echo $commande['nom_plat']; ?> </td>
                                <td><?php echo number_format($commande['prix'], 2); ?>€</td>
                            </tr>
                            <tr>
                            </tr>
                        </tbody>

                    <?php
                    }
                    ?>
                </table>
                <tr>Prix Total : <?php echo number_format($prixTT['TT'], 2); ?>€</tr>
                <tr>
                    <form method="POST">
                        <input name="action" type="hidden" value="Payer">
                        <input name="id_ticket" id="id_ticket" type="hidden" value=<?php echo $numTicket ?>>
                        <input type="submit" name="Validez" value="Payer">
                    </form>

                </tr>
            </div>
        <?php
        } ?>
    </div>

</body>

</html>
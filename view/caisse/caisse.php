<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<?php
if ($_SESSION["role"] == "caisse") {
	ini_set('display_errors', 'off');  // Bloque les erreur php

?>
	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Commande</title>
		<!-- Lien CSS -->
		<link rel="stylesheet" href="/SGRC/css/style_admin/tableau_de_bord/tableau_de_bord.css" />
		<link rel="stylesheet" href="/SGRC/css/style_bar/bar.css">
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
					<!-- Ticket -->
					<a href="?page=encours" class="active">
						<i class="fa-solid fa-file"></i>
						<h3>Commande en cour</h3>
					</a>
					<a href="?page=historique" class="">
						<i class="fa-solid fa-file"></i>
						<h3>Historique</h3>
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
				<!-- Titre de la page -->
				<h1>Commande en cours</h1>

				<!-- Section des tickets -->
				<div class="card_ticket">
					<?php
					// Boucle pour chaque ticket en cours au bar
					foreach ($ticketsBar as $ticketBar) {
					?>
						<div class="ticket">
							<?php
							// Affichage du numero de la table et du numero de ticket
							?>

							<!-- Tableau pour afficher les details de la commande -->
							<table>
								<caption>
									<?php
									// Affichage du numero de la table et du numero de ticket
									echo "Table n° :" . "\n" . $ticketBar['numero_table'] . '<br/>';
									echo "N° Ticket : #";
									
									// Formatage du numero de ticket avec des zeros a gauche
									$numTicket = $ticketBar['id_ticket'];
									while (strlen($numTicket) < 3) {
										$numTicket = '0' . $numTicket;
									}
									
									// Affichage du numero de ticket formate
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
								// Recuperation des commandes pour ce ticket
								$idticket_caisse = $ticketBar['id_ticket'];
								$statmt17->execute();
								$commandes = $statmt17->fetchAll();
								
								// Recuperation du prix total pour ce ticket
								$statmt20->execute();
								$prixTT = $statmt20->fetch(PDO::FETCH_ASSOC);

								// Affichage des details de chaque commande
								foreach ($commandes as $commande) {
								?>
									<tbody>
										<tr>
											<td><?php echo $commande['quantité']; ?> </td>
											<td><?php echo $commande['nom_plat']; ?> </td>
											<td><?php echo number_format($commande['prix'], 2); ?>€</td>
										</tr>
										<tr></tr>
									</tbody>

								<?php
								}
								?>

							</table>

							<!-- Affichage du prix total pour ce ticket -->
							<tr>Prix Total : <?php echo number_format($prixTT['TT'], 2); ?>€</tr>

							<!-- Formulaire pour payer le ticket -->
							<tr>
								<form method="POST">
									<input name="action" type="hidden" value="Payer">
									<input name="id_ticket" id="id_ticket" type="hidden" value=<?php echo $numTicket ?>>
									<input type="submit" name="Validez" value="Payer">
								</form>
							</tr>
						</div>
					<?php
					}
					?>
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
							<p style="text-transform: uppercase;"><b><?php echo $_SESSION['role'] ?></b></p>
						</div>
						<div class="profil-photot">
							<img src="/SGRC/php/images/<?php echo $row['image']; ?>" alt="">
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
		<!-- SCRIPT JQUERY POUR FONTION LOADER NOTIFICATION -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script>
			// Recharger la page avce intervale
			setInterval('load_ticket()', 2000);

			function load_ticket() {
				// Fonction load permet de charger le contenu un fichier a jquery
				$(".card_ticket").load("/SGRC/view/caisse/load_ticket.php");
			};
		</script>
	</body>
	</html>
<?php

} else {
	echo ("vous n'avez pas le droit d'être là");
	header("Location:../../../index.php");
	exit();
}
?>
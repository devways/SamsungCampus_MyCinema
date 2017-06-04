<div  class="col-md-9">
	<div class="col-md-9">
		<?php
		$film = $db->query("SELECT * from tp_film WHERE titre = \"" . htmlspecialchars($_GET["name_film"]) . "\" LIMIT 1");
		while($tab = $film->fetch(PDO::FETCH_ASSOC)) { 
			?>
			<table class="table-striped col-md-9">
				<tr><td>titre</td><td> <?php echo $tab["titre"]?> </td></tr>
				<tr><td>resum</td><td> <?php echo $tab["resum"]?> </td></tr>
				<tr><td>date debut affichage</td><td> <?php echo $tab["date_debut_affiche"]?> </td></tr>
				<tr><td>date fin affichage</td><td> <?php echo $tab["date_fin_affiche"]?> </td></tr>
				<tr><td>duree</td><td> <?php echo $tab["duree_min"] . "min";?> </td></tr>
				<tr><td>annee production</td><td> <?php echo $tab["annee_prod"]?> </td></tr>
			</table>
			<?php
		}
		if (isset($_POST["film_historique"])) {
			$requete_sql_idfilm = $db->query("SELECT id_film from tp_film WHERE titre = \"" . htmlspecialchars($_GET["name_film"]) . "\"");
			$id_film = $requete_sql_idfilm->fetch(PDO::FETCH_NUM);
			$requete_sql_idperso = $db->query("SELECT id_perso from tp_fiche_personne WHERE email = \"" . htmlspecialchars($_COOKIE["login"]) . "\"");
			$id_perso = $requete_sql_idperso->fetch(PDO::FETCH_NUM);
			$requete_sql_idmembre = $db->query("SELECT id_membre from tp_membre WHERE id_fiche_perso =" . $id_perso[0]);
			$id_membre = $requete_sql_idmembre->fetch(PDO::FETCH_NUM);
			$date = date("Y-m-d h:i:s");
			$requete_ajout_film = $db->query("INSERT INTO tp_historique_membre (id_membre,id_film,date) VALUES (" . $id_membre[0] . ", " . $id_film[0] .  ",\"" . $date . "\")");
		}
		if(isset($_COOKIE["login"]) && $_COOKIE["login"] != "admin") { 
			$requete_sql_idfilm = $db->query("SELECT id_film from tp_film WHERE titre = \"" . htmlspecialchars($_GET["name_film"]) . "\"");
			$id_film = $requete_sql_idfilm->fetch(PDO::FETCH_NUM);
			$requete_sql_idperso = $db->query("SELECT id_perso from tp_fiche_personne WHERE email = \"" . htmlspecialchars($_COOKIE["login"]) . "\"");
			$id_perso = $requete_sql_idperso->fetch(PDO::FETCH_NUM);
			$requete_sql_idmembre = $db->query("SELECT id_membre from tp_membre WHERE id_fiche_perso =" . $id_perso[0]);
			$id_membre = $requete_sql_idmembre->fetch(PDO::FETCH_NUM);
			$historique_film = $db->query("SELECT * from tp_historique_membre LEFT JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre LEFT JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film WHERE tp_historique_membre.id_membre =" . $id_membre[0] . " AND tp_historique_membre.id_film=" . htmlspecialchars($id_film[0]));
			$histo = $historique_film->fetch();
			if(isset($histo) && $histo == null) {
				?>
				<form method=post <?php echo "action=\"index.php?name_film=" . urlencode(htmlspecialchars($_GET["name_film"])) . "\"";?>>
					<input type="submit" name="film_historique" value="ajouter se film a votre historique">
				</form>
				<?php
			}
			?>
		</div>
		<?php
	}
	if(isset($histo) && $histo != null) { 
		?>
		<form method=post class="col-md-9" <?php echo "action=\"index.php?name_film=" . urlencode($_GET["name_film"]) . "\"";?>>
			<div class="form-group col-md-9">
				<textarea class="form-control col-md-9" rows="3" id="comment" name="avis_user"></textarea>
			</div>
			<input type="submit" value="valider commentaire">
		</form>
		<?php
	} 
	$avis_film_count = $db->query("SELECT count(tp_historique_membre.id_film) from tp_historique_membre LEFT JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film
		LEFT JOIN tp_fiche_personne ON tp_historique_membre.id_membre = tp_fiche_personne.id_perso WHERE tp_film.titre = \"" . $_GET["name_film"] . "\"");
	$limitF = 5;
	if(isset($avis_film_count) && isset($limitF)) { 
		$tablF = $avis_film_count->fetch();
		if((ceil((int)$tablF[0] / (int)$limitF)) > 1) { 
			if(isset($_POST["a"])) {
				$indexLimitF = $limitF * ($_POST['a']-1); 
			}
			else {
				$indexLimitF = 0; 
			}
			?>
			<div class="col-md-9">
				<div id="nav" class="col-md-9">
					<form method="post">
						<input class="inline" type="submit" name="a" value="1"><p class="inline">...</p>
						<?php
						if (isset($_POST['a'])) { for($i = $_POST['a'] - 2; $i < $_POST['a'] + 3; $i++){ if($i > 1 && $i < ceil((int)$tablF[0] / (int)$limitF)) { 
							?>
							<input type="submit" name="a" class="inline" value=<?php echo "\"" . $i . "\""; ?>>
							<?php 
						}
					}
				}
				else { 
					for($i = 2; $i < 5; $i++){ if($i > 1 && $i < ceil((int)$tablF[0] / (int)$limitF)) { 
						?>
						<input type="submit" name="a" class="inline" value=<?php echo "\"" . $i . "\""; ?>> 
						<?php 
					}
				}
			}
			?>
			<p class="inline">...</p>
			<input type="submit" name="a" class="inline" value=<?php echo "\"" . ceil((int)$tablF[0] / (int)$limitF) . "\""; ?>>
		</form> 
	</div>
	<?php 
}
}
?>
<div id="scroll_film_detail" class="col-md-9">
	<?php
	if (isset($avis_film_count) && (ceil((int)$tablF[0] / (int)$limitF) > 1)) { 
		$avis_film_affichage = $db->query("SELECT * from tp_historique_membre LEFT JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film
			LEFT JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre LEFT JOIN tp_fiche_personne ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso WHERE tp_film.titre = \"" . $_GET["name_film"] . "\" LIMIT " . $indexLimitF . "," . $limitF);
	}
	else {
		$avis_film_affichage = $db->query("SELECT * from tp_historique_membre LEFT JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film
			LEFT JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre LEFT JOIN tp_fiche_personne ON tp_membre.id_fiche_perso = tp_fiche_personne.id_perso WHERE tp_film.titre = \"" . $_GET["name_film"] . "\"");
	}
	while($avis_film_affichage_array = $avis_film_affichage->fetch(PDO::FETCH_ASSOC)) {
		if ($avis_film_affichage_array["avis"]) {
			echo "<p><i>" . $avis_film_affichage_array["nom"] . "  " . $avis_film_affichage_array["prenom"] ."</i></p>";
			echo "<p>" . htmlspecialchars($avis_film_affichage_array["avis"]) . "</p>";
		}
	}
	?>
</div>
</div>

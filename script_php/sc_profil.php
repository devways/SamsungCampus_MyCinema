<?php
$sql_all_profil = $db->query("SELECT * from tp_fiche_personne LEFT JOIN  tp_membre on tp_fiche_personne.id_perso = tp_membre.id_fiche_perso LEFT JOIN tp_abonnement on tp_membre.id_abo = tp_abonnement.id_abo");
if(isset($_POST["personne"])) {
	$sql_profil_admin = $db->query("SELECT * from tp_fiche_personne LEFT JOIN  tp_membre on tp_fiche_personne.id_perso = tp_membre.id_fiche_perso LEFT JOIN tp_abonnement on tp_membre.id_abo = tp_abonnement.id_abo WHERE tp_fiche_personne.email LIKE \"". htmlspecialchars($_POST["personne"]) . "\"");
}
if(isset($_POST['login'])) {
	if (htmlspecialchars($_POST['login']) != "admin") {
		while($sql_profil = $sql_all_profil->fetch()) {
			if(htmlspecialchars($_POST['login']) == $sql_profil["email"]) {
				$_COOKIE["login"] = $_POST["login"];
				setcookie("login", $_POST['login']);
				break;
			}
		}
	}
	else if (htmlspecialchars($_POST['login']) == "admin") {
		$_COOKIE["login"] = $_POST["login"];
		setcookie("login", $_POST["login"]);
	}
}
if (isset($_COOKIE["login"]) && isset($_POST["value_menu"]) && $_POST["value_menu"] == "DECONECTION") {
	setcookie("login", "", -1);
	header("Location: profil.php");
}
if(isset($_POST["action_abo"]) && ($_POST["action_abo"] == "modifier" || $_POST["action_abo"] == "ajouter")) {
	$sql_profil_modifier = $db->query("SELECT id_abo from tp_abonnement WHERE nom = \"" . htmlspecialchars($_POST["abo"]) . "\"");
	$id_abonnement = $sql_profil_modifier->fetch();
	$sql_profil_idperso = $db->query("SELECT id_perso from tp_fiche_personne WHERE email = \"" . htmlspecialchars($_COOKIE["login"]) .  "\"");
	$id_perso = $sql_profil_idperso->fetch();
	$sql_profil_modifier_abo = $db->query("UPDATE tp_membre SET id_abo = " . $id_abonnement[0] .  " WHERE id_fiche_perso = " . $id_perso[0]);
}
if(isset($_POST["action_abo"]) && $_POST["action_abo"] == "suprimer") {
	$sql_profil_modifier = $db->query("SELECT id_abo from tp_abonnement WHERE nom = \"" . htmlspecialchars($_POST["abo"]) . "\"");
	$id_abonnement = $sql_profil_modifier->fetch();
	$sql_profil_idperso = $db->query("SELECT id_perso from tp_fiche_personne WHERE email = \"" . htmlspecialchars($_COOKIE["login"]) .  "\"");
	$id_perso = $sql_profil_idperso->fetch();
	$sql_profil_modifier_abo = $db->query("UPDATE tp_membre SET id_abo = " . "NULL" .  " WHERE id_fiche_perso = " . $id_perso[0]);
}
if(isset($_COOKIE["login"]) && $_COOKIE["login"] != "admin") {
	$requete_sql_idperso = $db->query("SELECT id_perso from tp_fiche_personne WHERE email = \"" . htmlspecialchars($_COOKIE["login"]) . "\"");
	$id_perso = $requete_sql_idperso->fetch(PDO::FETCH_NUM);
	$requete_sql_idmembre = $db->query("SELECT id_membre from tp_membre WHERE id_fiche_perso =" . $id_perso[0]);
	$id_membre = $requete_sql_idmembre->fetch(PDO::FETCH_NUM);
	if(isset($_POST["choix_supression"])) {
		$supr_film_histo = $db->query("DELETE from tp_historique_membre WHERE id_membre =" . $id_membre[0] . " AND id_film=". htmlspecialchars($_POST["choix_supression"]));
	}
	if(isset($_COOKIE["login"])) {
		$sql_profil_perso = $db->query("SELECT * from tp_fiche_personne LEFT JOIN  tp_membre on tp_fiche_personne.id_perso = tp_membre.id_fiche_perso LEFT JOIN tp_abonnement on tp_membre.id_abo = tp_abonnement.id_abo WHERE tp_fiche_personne.email LIKE \"" . htmlspecialchars($_COOKIE["login"]) . "\"");
	}
	$avis_film_count = $db->query("SELECT count(id_membre) from tp_historique_membre WHERE id_membre =" . $id_membre[0]);
	$limitF = 10;
	if(isset($avis_film_count) && isset($limitF)) { 
		$tablF = $avis_film_count->fetch();
		if((ceil((int)$tablF[0] / (int)$limitF)) > 1) { 
			if(isset($_POST["a"])) {
				$indexLimitF = $limitF * ($_POST['a']-1);
			}
			else {
				$indexLimitF = 0; 
			}
		}
	}
	if (isset($avis_film_count) && (ceil((int)$tablF[0] / (int)$limitF) > 1)) { 
		$historique_film = $db->query("SELECT * from tp_historique_membre LEFT JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre LEFT JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film WHERE tp_historique_membre.id_membre =" . $id_membre[0]. " ORDER BY tp_historique_membre.date" .  " LIMIT " . $indexLimitF . "," . $limitF );
	}
	else {
		$historique_film = $db->query("SELECT * from tp_historique_membre LEFT JOIN tp_membre ON tp_historique_membre.id_membre = tp_membre.id_membre LEFT JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film WHERE tp_historique_membre.id_membre =" . $id_membre[0] . " ORDER BY tp_historique_membre.date");
	}

}
if(isset($_POST["titre"]) && isset($_POST["resum"]) && isset($_POST["date_debut"]) && isset($_POST["date_fin"]) && isset($_POST["duree_min"]) 
	&& isset($_POST["annee_prod"]) && isset($_POST["categorie"]) && isset($_POST["distrib"])) {
	$date_debut = strtotime(htmlspecialchars($_POST["date_debut"]));
$date_debut = date('Y-m-d H:i:s', $date_debut);
$date_fin = strtotime(htmlspecialchars($_POST["date_fin"]));
$date_fin = date('Y-m-d H:i:s', $date_fin);
$annee_prod = strtotime(htmlspecialchars($_POST["annee_prod"]));
$annee_prod = date('Y', $annee_prod);
$sql_distrib = $db->query("SELECT id_distrib from tp_distrib where nom=\"" . htmlspecialchars($_POST["distrib"]) . "\"");
$sql_genre = $db->query("SELECT id_genre from tp_genre where nom=\"" . htmlspecialchars($_POST["categorie"]) . "\"");
$sql_film_count = $db->query("SELECT count(titre) from tp_film");
$id_filmC = $sql_film_count->fetch();
$id_filmR = $id_filmC[0] + 1;
$id_distrib = $sql_distrib->fetch();
$id_genre = $sql_genre->fetch();
$sql_push_film = $db->query("INSERT INTO tp_film (id_film,id_genre,id_distrib,titre,resum,date_debut_affiche,date_fin_affiche,duree_min,annee_prod) VALUES (\"" . $id_filmR . "\", " . $id_genre[0] . ", " . $id_distrib[0] . ", \"" . htmlspecialchars($_POST["titre"]) . "\", \"" . htmlspecialchars($_POST["resum"]) . "\",\"" . $date_debut . "\", \"" . $date_fin . "\", \"" . htmlspecialchars($_POST["duree_min"]) . "\", \"" . $annee_prod . "\")");
}
?>
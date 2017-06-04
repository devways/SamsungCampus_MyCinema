<?php
if (isset($_POST['titre']) && isset($_POST['categorie']) && isset($_POST['distrib'])) {
	$titre = htmlspecialchars($_POST['titre']);
	$categorie = htmlspecialchars($_POST['categorie']);
	$distrib = htmlspecialchars($_POST['distrib']);
	$limit = htmlspecialchars($_POST["limit"]);
	$sql = "SELECT tp_film.titre, tp_genre.nom, tp_distrib.nom FROM tp_film LEFT JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre 
	LEFT JOIN tp_distrib ON tp_film.id_distrib = tp_distrib.id_distrib WHERE titre LIKE \"%".$titre."%\"";
	$count = "SELECT (count(tp_film.titre)) FROM tp_film LEFT JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre 
	LEFT JOIN tp_distrib ON tp_film.id_distrib = tp_distrib.id_distrib WHERE titre LIKE \"%".$titre."%\"";
	if (isset($_POST['p'])) {
		$index = $_POST['p'] - 1;
	}
	else {
		$index = 0;
	}
	$indexLimit = $limit * $index;
	$sql_categorie = " AND tp_genre.nom = \"" . $categorie . "\"";
	$sql_distrib = " AND tp_distrib.nom = \"". $distrib . "\"";
	$sql_limit = " LIMIT " . $indexLimit . "," . $limit;
	if ($categorie != "all") {
		$sql .= $sql_categorie;
		$count .= $sql_categorie;
	}
	if ($distrib != "all") {
		$sql .= $sql_distrib;
		$count .= $sql_distrib;
	}
	$sql .= " ORDER BY tp_film.titre ASC";
	if ($limit != "all") {
		$sql .= $sql_limit;
	}
	$requete_sql = $db->prepare($sql);
	$requete_sql_count = $db->prepare($count);
}
if (isset($_POST["avis_user"]) && $_POST["avis_user"] != NULL) {
	$requete_sql_idfilm = $db->query("SELECT id_film from tp_film WHERE titre = \"" . htmlspecialchars($_GET["name_film"]) . "\"");
	$id_film = $requete_sql_idfilm->fetch(PDO::FETCH_NUM);
	$requete_sql_idperso = $db->query("SELECT id_perso from tp_fiche_personne WHERE email = \"" . htmlspecialchars($_COOKIE["login"]) . "\"");
	$id_perso = $requete_sql_idperso->fetch(PDO::FETCH_NUM);
	$requete_sql_idmembre = $db->query("SELECT id_membre from tp_membre WHERE id_fiche_perso =" . $id_perso[0]);
	$id_membre = $requete_sql_idmembre->fetch(PDO::FETCH_NUM);
	$requete_avis_ajout = $db->query("UPDATE tp_historique_membre SET avis =\"". $_POST["avis_user"] . "\" WHERE id_membre=" .$id_membre[0] . " AND id_film=" . $id_film[0]);
}
$creat_coumn_avis = $db->query("ALTER TABLE tp_historique_membre ADD avis VARCHAR(255)");		
?>
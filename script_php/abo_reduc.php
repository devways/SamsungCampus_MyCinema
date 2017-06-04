<?php
if(isset($_GET["tarif"]) && htmlspecialchars($_GET["tarif"]) == "reduc") {
	$sql = $db->query("SELECT nom,pourcentage_reduc FROM tp_reduction ORDER BY pourcentage_reduc DESC");
}
if(isset($_GET["tarif"]) && htmlspecialchars($_GET["tarif"]) == "abo") {
	$sql = $db->query("SELECT nom,prix,duree_abo FROM tp_abonnement ORDER BY PRIX DESC");
}
?>
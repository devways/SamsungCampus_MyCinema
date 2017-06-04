<!DOCTYPE html>
<?php
$db = new PDO('mysql:host=localhost;dbname=mycinema', 'root', '');
?>
<html>
<head>
	<?php
	include "include/head.php";
	?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="jumbotron col-md-12">
				<h1>A l'Affiche actuellement</h1>      
				<p>tous vos films disponible en salle actuellement</p>
			</div>
			<?php
			include "include/navbar.php";
			$date = date("Y-m-d h:i:s");
			$sql_film_affiche = $db->query("SELECT titre from tp_film WHERE date_fin_affiche >=\"" . $date . "\" ORDER BY date_fin_affiche desc");
			while($list_film = $sql_film_affiche->fetch(PDO::FETCH_NUM)) {
				?>
				<a class="affiche" href=<?php echo "\"index.php?name_film=" . urlencode($list_film[0]) . "\"";?> > <?php echo $list_film[0]; ?></a>
				<?php
			}
			?>
		</div>
		</div>
	</body>
	</html>
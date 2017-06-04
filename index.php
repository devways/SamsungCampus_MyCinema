<!DOCTYPE html>
<?php 
$db = new PDO('mysql:host=localhost;dbname=mycinema', 'root', '');
include "script_php/recherche_croiser.php";
?>
<html>
<head>
	<?php
	include "include/head.php";
	?>
</head>
<body>
	<div class="container">
		
		<!-- <div class="col-md-12"> -->
		<?php
		include "include/navbar.php";
		?>
		<div class="row">
			<div class="jumbotron col-md-12">
				<h1>Films</h1>      
				<p>Vous pouvez rechercher vos film de diferente facon, acceder au detail les ajouter a votre historique oubien donner un avis sur ceci une fois vu</p>
			</div>
		</div>
		<!-- </div> -->
		<!-- </div> -->
		<div class="row">
			<?php
			include "include/menu_recherche_croiser.php";
			if (!isset($_GET["name_film"])) {
				include "include/conteneur_recherche_croiser.php";
			}
			else {
				include "include/conteneur_detail_film.php";
			}
			?>
		</div>
	</div>
</body>
</html>
<!DOCTYPE html>
<?php 
$db = new PDO('mysql:host=localhost;dbname=mycinema', 'root', '');
include "script_php/abo_reduc.php";
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
				<h1>Tarif</h1>      
				<p>Observer la competitiviter de nos tarif, nos abonnement et nos reduction rien que pour vous</p>
			</div>
			<?php
			include "include/navbar.php";
			include "include/menu_tarif.php";
			include "include/conteneur_tarif.php";
			?>
		</div>
	</div>
</body>
</html>
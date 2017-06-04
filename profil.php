<!DOCTYPE html>
<?php
$db = new PDO('mysql:host=localhost;dbname=mycinema', 'root', '');
include "script_php/sc_profil.php";
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
				<h1>Profils</h1>      
				<p>Acceder aux details du profils, a vos historique ou bien votre abonnement</p>
			</div>
			<?php
			include "include/navbar.php";
			if (isset($_COOKIE["login"]) && $_COOKIE["login"] == "admin") {
				?>
				<?php
				include "include/menu_profil.php";
				if (isset($_COOKIE["login"]) && isset($_POST["value_menu"]) && htmlspecialchars($_POST["value_menu"]) == "FILM") {
					include "include/menu_profil_film.php";
				}
				?>
				<?php
			}
			else if (isset($_COOKIE["login"]) && $_COOKIE["login"] != "admin") {
				?>
				<?php
				include "include/menu_profil.php";
				if (isset($_COOKIE["login"]) && isset($_POST["value_menu"]) && htmlspecialchars($_POST["value_menu"]) == "DETAIL") {
					include "include/menu_profil_detail.php";
				}
				elseif (isset($_COOKIE["login"]) && isset($_POST["value_menu"]) && htmlspecialchars($_POST["value_menu"]) == "ABONNEMENT") {
					include "include/menu_profil_abo.php";
				}
				elseif (isset($_COOKIE["login"]) && isset($_POST["value_menu"]) && htmlspecialchars($_POST["value_menu"]) == "HISTORIQUE") {
					include "include/menu_profil_historique.php";
				}	
			}
			else {
				?>
				<form method="post" action="profil.php">
					<input type="text" class="form-control" placeholder="Text input" name="login">
					<input type="submit" value="ok">
				</form>
				<?php
			}
			?>
		</div>
	</div>
</body>
</html>
<form method="post" action="profil.php" id="profil_abo">
	<?php
	if(isset($_COOKIE["login"]) && htmlspecialchars($_COOKIE["login"]) != "admin") { 
		?>
		<input class="btn btn-primary" type="submit" value="DETAIL" name="value_menu">
		<input class="btn btn-primary" type="submit" value="ABONNEMENT" name="value_menu">
		<input class="btn btn-primary" type="submit" value="HISTORIQUE" name="value_menu">
		<?php
	}
	elseif (isset($_COOKIE["login"]) && htmlspecialchars($_COOKIE["login"]) == "admin") { 
		?>
		<input class="btn btn-primary" type="submit" value="FILM" name="value_menu">
		<?php
	}
	?>
	<input class="btn btn-primary" type="submit" value="DECONECTION" name="value_menu">
</form>
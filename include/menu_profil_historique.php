<div id="nav">
	<form method="post">
		<input type="text" name="value_menu" value="HISTORIQUE" style="display:none">
		<?php 
		if (isset($avis_film_count) && (ceil((int)$tablF[0] / (int)$limitF) > 1)) { 
			?>
			<input type="submit" name="a" value="1" class="inline"><p class="inline">...</p>
			<?php 
			if (isset($_POST['a'])) { for($i = $_POST['a'] - 2; $i < $_POST['a'] + 3; $i++) { 
				if($i > 1 && $i < ceil((int)$tablF[0] / (int)$limitF)) { 
					?>
					<input type="submit" name="a" class="inline" value=<?php echo "\"" . $i . "\""; ?>>
					<?php 
				}
			}
		}
		else { 
			for($i = 2; $i < 5; $i++) { 
				if($i > 1 && $i < ceil((int)$tablF[0] / (int)$limitF)) { 
					?>
					<input type="submit" name="a" class="inline" value=<?php echo "\"" . $i . "\""; ?>> 
					<?php
				}
			}
		}
		?>
		<p class="inline">...</p>
		<input type="submit" name="a" class="inline" value=<?php echo "\"" . ceil((int)$tablF[0] / (int)$limitF) . "\""; ?>>
		<?php 
	} 
	?>
</form> 
</div>
<div id="idHistorique scroll_film_detail">
	<form method="post" action="profil.php" id="formSupr"></form>
	<?php
	while($histo_film = $historique_film->fetch()) {
		?>
		<input type="text" form="formSupr" name="value_menu" value="HISTORIQUE" style="display:none">
		<label><input form="formSupr" type="radio" name="choix_supression" <?php echo "value=\"" . $histo_film["id_film"] . "\""?>>suprimer</label>
		<?php
		echo "<p>" . $histo_film["titre"] . " : " . $histo_film["date"] . "</p>";
	}
	?>
	<input type="submit" form="formSupr">
</div>
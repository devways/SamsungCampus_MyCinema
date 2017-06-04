<?php
while($sql_profil = $sql_profil_perso->fetch()) {
	if($sql_profil["id_abo"] != NULL) {
		?>
		<tr>
			<td>
				<?php
				echo $sql_profil[17];
				?>
			</td>
			<td>
				<?php
				echo $sql_profil[18];
				?>
			</td>
			<td>
				<?php
				echo $sql_profil[19];
				?>
			</td>
			<td>
				<?php
				echo $sql_profil[20];
				?>
			</td>
			<td>
				<?php
				echo $sql_profil[12];
				?>
			</td>
		</tr>
		<form method="post" action="profil.php" id=profil_aboA></form>
		<select name="abo" form="profil_aboA">
			<option>GOLD</option>
			<option>malsch</option>
			<option>VIP</option>
			<option>Classic</option>
			<option>pass day</option>
		</select>
		<input type="text" form="profil_aboA" name="value_menu" value="ABONNEMENT" style="display:none">
		<input type="submit" value="modifier" form="profil_aboA" name="action_abo">
		<input type="submit" value="suprimer" form="profil_aboA" name="action_abo">
		<?php
	}
	else {
		?>
		<form method="post" action="profil.php" id=profil_aboA>
			<select name="abo" form="profil_aboA">
				<option>GOLD</option>
				<option>malsch</option>
				<option>VIP</option>
				<option>Classic</option>
				<option>pass day</option>
			</select>
			<input type="text" form="profil_aboA" name="value_menu" value="ABONNEMENT" style="display:none">
			<input type="submit" value="ajouter" form="profil_aboA" name="action_abo">
			<?php
		}
	}
	?>
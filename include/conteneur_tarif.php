<div id="content" class="col-md-7">
	<table class="table-striped table-hover col-md-7">
		<?php
		if (isset($_GET["tarif"]) && htmlspecialchars($_GET["tarif"]) == "reduc") {
			while($tab = $sql->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
					<td> <?php echo $tab["nom"];?></td>
					<td> <?php echo $tab["pourcentage_reduc"] . "%";?></td>
				</tr>
				<?php
			}
		}
		if (isset($_GET["tarif"]) && htmlspecialchars($_GET["tarif"]) == "abo") {
			while($tab = $sql->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
					<td> <?php echo $tab["nom"];?></td>
					<td> <?php echo $tab["prix"] . '$';?></td>
					<td> <?php echo $tab["duree_abo"] . " Jour";?></td>
				</tr>
				<?php
			}
		}
		?>
	</table>
</div>
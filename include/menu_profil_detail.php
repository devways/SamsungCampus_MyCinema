<?php
while($sql_profil = $sql_profil_perso->fetch()) {
	?>
	<table>
		<tr>
			<td>
				<p>
					NOM:
				</p>
			</td>
			<td>
				<p>
					<?php
					echo $sql_profil[1];
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					PRENOM:
				</p>
			</td>
			<td>
				<p>
					<?php
					echo $sql_profil[2];
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>DATE DE NAISSANCE:</p>
			</td>
			<td>
				<p>
					<?php
					echo $sql_profil[3];
					?>
				</p>
				<tr>
					<td>
						<p>EMAIL:</p>
					</td>
					<td>
						<p>
							<?php
							echo $sql_profil[4];
							?>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>ADRESSE:</p>
					</td>
					<td>
						<p>
							<?php
							echo $sql_profil[5];
							?>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>CODE POSTAL:</p>
					</td>
					<td>
						<p>
							<?php
							echo $sql_profil[6];
							?>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>VILLE:</p>
					</td>
					<td>
						<p>
							<?php
							echo $sql_profil[7];
							?>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>PAYS:</p>
					</td>
					<td>
						<p>
							<?php
							echo $sql_profil[8];
							?>
						</p>
					</td>
				</tr>
			</table>
			<?php
		}
		?>
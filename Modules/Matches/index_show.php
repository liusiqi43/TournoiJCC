<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; ?>

<!-- // Les css vont dans le assets/css/tournoi.css Et ne modifie jamais bootstrap.css -->
<h2>Les matchs!</h2>
<div style="float:right;">
	<table class="table text-right">
		<tbody>
			<tr>
				<?php foreach ($annees as $a): ?>
				<td><a href="?annee=<?php echo $a; ?>"><?php echo $a; ?></a></td>
			<?php endforeach ?>
		</tr>
	</tbody>
</table>
</div>
<h3><?php echo $annee; ?></h3>

<?php if (isset($error)): ?>
	<?php echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error."</strong></div>"; ?>
<?php elseif(isset($_SESSION['last_error_msg'])): ?>
	<?php echo "<div class=\"alert alert-danger fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$db->last_error_msg()."</strong></div>"; ?>
<?php endif; ?>

<?php if (isset($action) && ($action=="modify" || $action=="new")): ?>
	<div class="alert alert-info fade in" style="padding:40px">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<form action="update_success.php" method="POST">
			<?php if ($action=="modify"): ?>
				<h3>Modification d'un match</h3>
			<?php else: ?>
				<h3>Ajout d'un nouveau match</h3>
			<?php endif ?>
			<table class="table table-striped">
				<tr>
					<input type="hidden" name="action" value="<?php echo $action; ?>">
					<input type="hidden" name="key_column" value="<?php echo $match_to_modify->key; ?>">
					<tr><td>annee tournoi:&nbsp&nbsp</td><td><input type="text" name="annee_tournoi" readonly value="<?php echo $match_to_modify->annee_tournoi; ?>"></td></tr>
					<tr>
						<td>jour:&nbsp&nbsp</td><td><input type="text" name="jour" id="dpMatch" value="<?php echo $match_to_modify->jour; ?>"></td>
					</tr>
					<tr><td>horaire:&nbsp&nbsp</td><td>
						<select name="horaire"?>
							<option value="<?php echo $match_to_modify->horaire; ?>" selected="selected"><?php echo $match_to_modify->horaire; ?></option>
							<option value="08:00">08:00</option>
							<option value="08:30">08:30</option>
							<option value="09:00">09:00</option>
							<option value="09:30">09:30</option>
							<option value="10:00">10:00</option>
							<option value="10:30">10:30</option>
							<option value="11:00">11:00</option>
							<option value="11:30">11:30</option>
							<option value="12:00">12:00</option>
							<option value="12:30">12:30</option>
							<option value="13:00">13:00</option>
							<option value="13:30">13:30</option>
							<option value="14:00">14:00</option>
							<option value="14:30">14:30</option>
							<option value="15:00">15:00</option>
							<option value="15:30">15:30</option>
							<option value="16:00">16:00</option>
							<option value="16:30">16:30</option>
							<option value="17:00">17:00</option>
							<option value="17:30">17:30</option>
							<option value="18:00">18:00</option>
						</select>
					</td></tr>
				<tr>
					<td>numero de table:&nbsp&nbsp</td><td><input type="text" name="numerotable" value="<?php echo $match_to_modify->numeroTable; ?>"></td>
				</tr>
				<tr>
					<td>numero de salle:&nbsp&nbsp</td><td><input type="text" name="numerosalle" value="<?php echo $match_to_modify->numeroSalle; ?>"></td>
				</tr>
				<tr>
					<td>joueur 1: &nbsp&nbsp</td>
					<td>
						<select name="j1"?>
							<?php foreach ($joueurs as $j): ?>
								<?php if ($match_to_modify->j1 == $j["login"]): ?>
									<option selected="selected" value="<?php echo $j["login"]; ?>"><?php echo $j["surnom"].' ('.$j["login"].')' ?></option>
								<?php else: ?>
									<option value="<?php echo $j['login']; ?>"><?php echo $j["surnom"].' ('.$j["login"].')' ?></option>
								<?php endif; ?>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>joueur 2:&nbsp&nbsp</td>
					<td>
						<select name="j2"?>
							<?php foreach ($joueurs as $j): ?>
								<?php if ($match_to_modify->j2 == $j["login"]): ?>
									<option selected="selected" value="<?php echo $j["login"]; ?>"><?php echo $j["surnom"].' ('.$j["login"].')' ?></option>
								<?php else: ?>
									<option value="<?php echo $j['login']; ?>"><?php echo $j["surnom"].' ('.$j["login"].')' ?></option>
								<?php endif; ?>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Vainqueur:&nbsp&nbsp</td>
					<td>
						<select name="victoire">
							<?php if ($match_to_modify->victoire == 0): ?>
								<option value="0" selected="selected">N\A</option>
								<option value="1">Joueur 1</option>
								<option value="2">Joueur 2</option>
							<?php elseif ($match_to_modify->victoire == 1): ?>
								<option value="0">N\A</option>
								<option value="1" selected="selected">Joueur 1</option>
								<option value="2">Joueur 2</option>
							<?php elseif ($match_to_modify->victoire == 2): ?>
								<option value="0">N\A</option>
								<option value="1">Joueur 1</option>
								<option value="2" selected="selected">Joueur 2</option>
							<?php endif ?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td><td><input type="submit" class="btn btn-success pull-right" name="update_match-submit" value="Valider"></td>
				</tr>
			</table>
		</form>
	</div>
<?php endif ?>


<h3>A venir</h3>
<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Année</th>
		<th>Jour</th>
		<th>Horaire</th>
		<th>Numero de salle</th>
		<th>Numero de table</th>
		<th>Joueur 1 (Surnom)</th>
		<th>Joueur 2 (Surnom)</th>
		<th>Vainqueur</th>
		<?php if ($admin): ?>
			<th>Actions</th>
		<?php endif ?>
	</tr>
	<?php if (isset($error_f)) {
		echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error_f."</strong></div>";
	} ?>
<?php if (is_array($matchs_futur)): ?>
	<?php foreach ($matchs_futur as $match): ?>
		<tr>
			<td><?php echo $match["annee_tournoi"]; ?></td>
			<td><?php echo $match["jour"]; ?></td>
			<td><?php echo $match["horaire"]; ?></td>
			<td><?php echo $match["numerosalle"]; ?></td>
			<td><?php echo $match["numerotable"]; ?></td>
			<td><?php echo $match["j1"].' ('.$match["j1_n"].')'; ?></td>
			<td><?php echo $match["j2"].' ('.$match["j2_n"].')'; ?></td>
			<td>N/A</td>
			<?php if ($admin): ?>
			<td>
				<?php $id = $match['key_column']; ?>
				<?php echo "<a href=\"?annee=$annee&modify=$id\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i></a>"; ?>
				<?php echo "<a href=\"?annee=$annee&delete=$id\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a>"; ?>
			</td>
			<?php endif ?>
		</tr>
	<?php endforeach ?>
	<?php endif ?>
</tbody></table>

<h3>A enreigistrer</h3>
<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Année</th>
		<th>Jour</th>
		<th>Horaire</th>
		<th>Numero de salle</th>
		<th>Numero de table</th>
		<th>Joueur 1 (Surnom)</th>
		<th>Joueur 2 (Surnom)</th>
		<th>Vainqueur</th>
	</tr>
	<?php if (isset($error_pe)) {
		echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error_pe."</strong></div>";
	} ?>

	<?php if (is_array($matchs_past_non_valide)): ?>
	<?php foreach ($matchs_past_non_valide as $match): ?>
		<tr>
			<td><?php echo $match["annee_tournoi"]; ?></td>
			<td><?php echo $match["jour"]; ?></td>
			<td><?php echo $match["horaire"]; ?></td>
			<td><?php echo $match["numerosalle"]; ?></td>
			<td><?php echo $match["numerotable"]; ?></td>
			<td><?php echo $match["j1"].' ('.$match["j1_n"].')'; ?></td>
			<td><?php echo $match["j2"].' ('.$match["j2_n"].')'; ?></td>
			<td>
				<?php if ($admin): ?>
					<?php $id = $match['key_column']; ?>
					<?php echo "<a href=\"?annee=$annee&j=$id&v=1\" class=\"btn btn-primary\">⓵</a>"; ?>
					<?php echo "<a href=\"?annee=$annee&j=$id&v=2\" class=\"btn btn-primary\">⓶</a>"; ?>
				<?php endif ?>
			</td>
		</tr>
	<?php endforeach ?>

	<?php endif ?>
</tbody></table>


<h3>Terminés</h3>
<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Année</th>
		<th>Jour</th>
		<th>Horaire</th>
		<th>Numero de salle</th>
		<th>Numero de table</th>
		<th>Joueur 1 (Surnom)</th>
		<th>Joueur 2 (Surnom)</th>
		<th>Vainqueur</th>
		<?php if ($admin): ?>
			<th>Actions</th>
		<?php endif ?>
	</tr>
	<?php if (isset($error_p)) {
		echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error_p."</strong></div>";
	} ?>

<?php if (is_array($matchs_past)): ?>
	<?php foreach ($matchs_past as $match): ?>
		<tr>
			<td><?php echo $match["annee_tournoi"]; ?></td>
			<td><?php echo $match["jour"]; ?></td>
			<td><?php echo $match["horaire"]; ?></td>
			<td><?php echo $match["numerosalle"]; ?></td>
			<td><?php echo $match["numerotable"]; ?></td>
			<td><?php echo $match["j1"].' ('.$match["j1_n"].')'; ?></td>
			<td><?php echo $match["j2"].' ('.$match["j2_n"].')'; ?></td>
			<td><?php echo $match["victoire"]; ?></td>
			<?php if ($admin): ?>
			<td>
				<?php $id = $match['key_column']; ?>
				<?php echo "<a href=\"?annee=$annee&modify=$id\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i></a>"; ?>
				<?php echo "<a href=\"?annee=$annee&delete=$id\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a>"; ?>
			</td>
			<?php endif ?>
		</tr>
	<?php endforeach ?>
	<?php endif ?>
</tbody></table>


<?php if ($admin): ?>
	<!-- // utilisateur est org de l'annee courant, il peut donc modifie -->
	<p class="button-row">
		<a href="?annee=<?php echo $annee; ?>&new=?>" class="btn btn-success"><i class="icon-plus icon-white"></i>Ajouter un match</a>
	</p>
<?php endif; ?>


<!-- footer -->
<?php require_once $ROOT.'footer.php';

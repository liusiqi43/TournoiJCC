<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; ?>

<h2>Les Organisateurs</h2>
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

<?php if (isset($action) && $action=="modify"): ?>
	<div class="alert alert-info fade in" style="padding:40px">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<form action="update_success.php" method="POST">
			<h3>Modification d'un organisateur</h3>
			<table class="table table-striped">
				<tr>
					<input type="hidden" name="action" value="modify">
					<tr><td>login:&nbsp&nbsp</td><td><input type="text" name="login" readonly value="<?php echo $org_to_modify->login; ?>"></td></tr>
					<input type="hidden" name="pwd" value="<?php echo $org_to_modify->password; ?>">
					<tr><td>année d'organisation:&nbsp&nbsp</td><td><input type="text" name="annee" readonly value="<?php echo $org_to_modify->annee; ?>"></td></tr>
					<td>nom:&nbsp&nbsp</td><td><input type="text" name="nom" value="<?php echo $org_to_modify->nom; ?>"></td>
				</tr>
				<tr>
					<td>prenom:&nbsp&nbsp</td><td><input type="text" name="prenom" value="<?php echo $org_to_modify->prenom; ?>"></td>
				</tr>
				<tr>
					<td>address:&nbsp&nbsp</td><td><input type="text" name="address" value="<?php echo $org_to_modify->adresse; ?>"></td>
				</tr>
				<tr>
					<td>telephone:&nbsp&nbsp</td><td><input type="text" name="telephone" value="<?php echo $org_to_modify->telephone; ?>"></td>
				</tr>
				<tr>
					<td>date de naissance: &nbsp&nbsp</td><td><input type="text" id="dpMatch" name="dateDeNaissance" value="<?php echo $org_to_modify->datedenaissance; ?>"></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" class="btn btn-success pull-right" name="update_org-submit" value="Valider"></td>
				</tr>
			</table>
		</form>
	</div>
<?php endif ?>


<?php if (isset($action) && $action == "new"): ?>
	<div class="row">
		<div class="span6">
			<h3>Déjà Membre?</h3>
			<form action="update_success.php" method="POST">
				<table>
					<tr>
						<input type="hidden" name="action" value="new_org">
						<input type="hidden" name="pwd" value="<?php echo $org_to_modify->password; ?>">
						<td>login:&nbsp&nbsp</td><td>
							<select name="login">
								<?php foreach ($logins as $login): ?>
									<option value=<?php echo '"'.$login['login'].'"'?>><?php echo $login['login']?></option>
								<?php endforeach ?>
							</select>
					</td>
					</tr>
					<tr>
						<td>telephone:&nbsp&nbsp</td><td><input type="text" name="telephone" value="<?php echo $org_to_modify->telephone; ?>"></td>
					</tr>
					<tr>
						<td>année d'organisation:&nbsp&nbsp</td><td><input type="text" name="annee" readonly value="<?php echo $org_to_modify->annee; ?>"></td>
					</tr>
				<tr>
					<td></td><td><input type="submit" class="btn btn-success pull-right" name="update_org-submit" value="Valider"></td>
				</tr>
			</table>
			</form>
		</div>
		<div class="span6">
			<h3>Nouveau Membre?</h3>
			<form>
				<table>
					<tr>
						<input type="hidden" name="action" value="new">
						<input type="hidden" name="pwd" value="<?php echo $org_to_modify->password; ?>">
						<td>login:&nbsp&nbsp</td><td><input type="text" name="login" value="<?php echo $org_to_modify->login; ?>"></td>
					</tr>
					<tr>
						<td>année d'organisation:&nbsp&nbsp</td><td><input type="text" name="annee" readonly value="<?php echo $org_to_modify->annee; ?>"></td>
					</tr>
					<tr><td>nom:&nbsp&nbsp</td><td><input type="text" name="nom" value="<?php echo $org_to_modify->nom; ?>"></td>
				</tr>
				<tr>
					<td>prenom:&nbsp&nbsp</td><td><input type="text" name="prenom" value="<?php echo $org_to_modify->prenom; ?>"></td>
				</tr>
				<tr>
					<td>address:&nbsp&nbsp</td><td><input type="text" name="address" value="<?php echo $org_to_modify->adresse; ?>"></td>
				</tr>
				<tr>
					<td>telephone:&nbsp&nbsp</td><td><input type="text" name="telephone" value="<?php echo $org_to_modify->telephone; ?>"></td>
				</tr>
				<tr>
					<td>date de naissance: &nbsp&nbsp</td><td><input type="text" id="dpMatch" name="dateDeNaissance" value="<?php echo $org_to_modify->datedenaissance; ?>"></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" class="btn btn-success pull-right" name="update_org-submit" value="Valider"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php endif ?>


<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Telephone</th>
			<?php if ($admin): ?>
			<th>Actions</th>
		<?php endif ?>
	</tr>
	<?php foreach ($orgs as $org): ?>
	<tr>
		<td><?php echo $org->nom; ?></td>
		<td><?php echo $org->prenom; ?></td>
		<td><?php echo $org->telephone; ?></td>
		<?php if ($admin): ?>
		<td>
			<?php echo "<a href=\"?annee=$annee&modify='$org->login'\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i></a>"; ?>
			<?php echo "<a href=\"?annee=$annee&delete='$org->login'\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a>"; ?>
		</td>
	<?php endif ?>
</tr>
<?php endforeach ?>
</tbody></table>

<?php if ($admin): ?>
	<!-- // utilisateur est org de l'annee courant, il peut donc modifie -->
	<p class="button-row">
		<a href="?annee=<?php echo $annee; ?>&new=?>" class="btn btn-success"><i class="icon-plus icon-white"></i>Ajouter un organisateur</a>
	</p>
<?php endif; ?>

<!-- footer -->
<?php require_once $ROOT.'footer.php';
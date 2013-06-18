<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; 
?>

<!-- // Les css vont dans le assets/css/tournoi.css Et ne modifie jamais bootstrap.css -->
<div style="float:right;">
	<table class="table text-right">
		<tbody><tr>
            <?php foreach ($annees as $a): ?>
            <td><a href="?annee=<?php echo $a; ?>"><?php echo $a; ?></a></td>
            <?php endforeach ?>
        </tr>
	</tbody></table>
</div>
<h1>Statistique</h1>

<h2><?php echo $annee ?></h2>

<?php if (isset($error)): ?>
    <?php echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error."</strong></div>"; ?>
<?php elseif(isset($_SESSION['last_error_msg'])): ?>
    <?php echo "<div class=\"alert alert-danger fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$db->last_error_msg()."</strong></div>"; ?>
<?php endif; ?>

<div class="well">
	<h3 align="center"> <i class="icon-trophy"></i>  <i class="icon-trophy"></i> Hall of Fame!  <i class="icon-trophy"></i> <i class="icon-trophy"></i></h3>
	<div class="row">
		<div class="span6">
			<h4 id="title_graphe">Répartition des cartes</h4>
			<form action="index_show.php" method="GET">
				<p>
					Consulter la répartition pour les 
					<select name="n_premier">
						<option value="1" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==1) echo "selected=\"selected\"";?>>champions</option>
						<option value="2" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==2) echo "selected=\"selected\"";?>>2 premiers</option>
						<option value="3" <?php if(isset($_GET["n_premier"]) &&$_GET["n_premier"]==3) echo "selected=\"selected\"";?>>3 premiers</option>
						<option value="4" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==4) echo "selected=\"selected\"";?>>4 premiers</option>
						<option value="5" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==5) echo "selected=\"selected\"";?>>5 premiers</option>
						<option value="6" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==6) echo "selected=\"selected\"";?>>6 premiers</option>
						<option value="7" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==7) echo "selected=\"selected\"";?>>7 premiers</option>
						<option value="8" <?php if(isset($_GET["n_premier"]) && $_GET["n_premier"]==8) echo "selected=\"selected\"";?>>Tous les joueurs qualifiés</option>
					</select>
					&nbsp&nbsp
					<input type="submit" class="btn btn-primary" name="consult_n_premier" value="Valider">
				</p>
			</form>

			<table class="table table-striped">
				<tr>
					<th>annee</th>
					<th>surnom</th>
					<th>type de carte</th>
					<th>nombre</th>
				</tr>
				<?php if (is_array($consult_joueurs)): ?>
					<?php foreach ($consult_joueurs as $j): ?>
						<tr>
							<td><?php echo $j["annee"]; ?></td>
							<td><?php echo $j["nick"]; ?></td>
							<td><?php echo $j["type"]; ?></td>
							<td><?php echo $j["count"]; ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</table>
		</div>
		<div class="span5">
			<div id="graph_container"  style="min-width: 400px; height: 400px; margin: 0"</div>
		</div>
	</div>
</div>
</div>


<div class="well">
	<h3 align="center"> <i class="icon-flag-alt"></i>  <i class="icon-flag-alt"></i> Hall of Shame...  <i class="icon-flag-alt"></i> <i class="icon-flag-alt"></i></h3>
	<?php if (isset($error_e)): ?>
    <?php echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error_e."</strong></div>"; ?>
    <?php endif; ?>

    <table class="table table-striped">
			<tr>
				<th>Login</th><th></th>
			</tr>
			<?php if (is_array($joueurs_elimine)): ?>
				<?php foreach ($joueurs_elimine as $j): ?>
					<tr>
						<td></td><td><?php echo $j["login"]; ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
			<tr>
				<td><strong>Total</strong></td>
				<td><?php echo count($joueurs_elimine); ?></td>
			</tr>
	</table>
</div>

<script type="text/javascript">
      var data_repartition = <?php echo json_encode($nb_repartition); ?>;
</script>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

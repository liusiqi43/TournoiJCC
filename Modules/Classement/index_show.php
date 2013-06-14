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
<h1>Classement</h1>

<h2><?php echo $annee ?></h2>

<?php if (isset($error)): ?>
    <?php echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error."</strong></div>"; ?>
<?php elseif(isset($_SESSION['last_error_msg'])): ?>
    <?php echo "<div class=\"alert alert-danger fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$db->last_error_msg()."</strong></div>"; ?>
<?php endif; ?>

<table class="table table-striped table-hover">
	<tbody>
	<tr>
    	<th>Joueur</th>
        <th>Matchs joués</th>
    	<th>Matchs gagnés</th>
        <th>Matchs perdus</th>
        <th>%</th>
	</tr>
    <?php foreach ($joueurs as $joueur):?>
        <tr>
            <td><?php echo $joueur['nick'] ?></td>
            <td><?php echo $joueur['total']?></td>
            <td><?php echo $joueur['win']?></td>
            <td><?php echo $joueur['lose']?></td>
            <td><?php echo ($joueur['win']/$joueur['total']*100).'%'?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

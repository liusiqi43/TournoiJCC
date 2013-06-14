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
<h1>Planning</h1>

<h2><?php echo $annee ?></h2>

<?php if (isset($error)): ?>
    <?php echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error."</strong></div>"; ?>
<?php elseif(isset($_SESSION['last_error_msg'])): ?>
    <?php echo "<div class=\"alert alert-danger fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$db->last_error_msg()."</strong></div>"; ?>
<?php endif; ?>


<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Jour</th>
        <th>Horaire</th>
        <th>Numéro de salle</th>
		<th>Numéro de table</th>
        <th>Joueur 1 (surnom)</th>
        <th>Joueur 2 (surnom)</th>
	</tr>

        
    <?php foreach ($matches as $match): ?>
    <?php if (time() > strtotime($match['jour'].' '.$match['horaire'])): ?>
        <tr class="warning">
    <?php else: ?>
        <tr class="success">
    <?php endif; ?>
            <td><?php echo $match['jour']; ?></td>
            <td><?php echo $match['horaire']; ?></td>
            <td><?php echo $match['numerosalle']; ?></td>
            <td><?php echo $match['numerotable']; ?></td>
            <td><?php echo $match['j1_n']; ?></td>
            <td><?php echo $match['j2_n']; ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
 </table>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

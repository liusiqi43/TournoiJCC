<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; ?>

<!-- // Les css vont dans le assets/css/tournoi.css Et ne modifie jamais bootstrap.css -->
<h2>Les matchs!</h2>
<div style="float:right;">
	<table class="table text-right">
		<tbody><tr>
			<td><a href="./matchs_files/matchs.htm">2008</a></td>
			<td><a href="./matchs_files/matchs.htm">2009</a></td>
			<td><a href="./matchs_files/matchs.htm">2010</a></td>
			<td><a href="./matchs_files/matchs.htm">2011</a></td>
			<td><a href="./matchs_files/matchs.htm">2012</a></td>
		</tr>
	</tbody></table>
	
</div>
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
	</tr><tr>
		<td>2012</td>
		<td>02/06</td>
		<td>12:00</td>
		<td>5</td>
		<td>18</td>
		<td>Sayanel</td>
		<td>Ahryus</td>
		<td>-</td>
	</tr>
	<tr>
		<td>2012</td>
		<td>04/06</td>
		<td>14:00</td>
		<td>4</td>
		<td>2</td>
		<td>Rezuru</td>
		<td>Mawochi</td>
		<td>-</td>
	</tr>
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
	</tr><tr>
		<td>2012</td>
		<td>01/06</td>
		<td>10:00</td>
		<td>7</td>
		<td>1</td>
		<td>Toto</td>
		<td>Titi</td>
		<td>Toto</td>
	</tr>
	<tr>
		<td>2012</td>
		<td>01/06</td>
		<td>14:00</td>
		<td>6</td>
		<td>2</td>
		<td>Gagamaury</td>
		<td>Kohrütz</td>
		<td>Gagamaury</td>
	</tr>
</tbody></table>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

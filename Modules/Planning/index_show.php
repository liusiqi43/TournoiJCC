<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; 
?>

<!-- // Les css vont dans le assets/css/tournoi.css Et ne modifie jamais bootstrap.css -->
<!-- <div style="float:right;">
	<table class="table text-right">
		<tbody><tr>
			<td><a href="./matchs_files/matchs.htm">2008</a></td>
			<td><a href="./matchs_files/matchs.htm">2009</a></td>
			<td><a href="./matchs_files/matchs.htm">2010</a></td>
			<td><a href="./matchs_files/matchs.htm">2011</a></td>
			<td><a href="./matchs_files/matchs.htm">2012</a></td>
		</tr>
	</tbody></table>
	
</div> -->
<h1>Planning</h1>
<h2>2012</h2>
<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Jour</th>
    <th>Horaire</th>
    <th>Numéro de salle</th>
		<th>Numéro de table</th>
    <th>Joueur 1</th>
    <th>Joueur 2</th>
	</tr><tr>
		<td>08/06</td>
    <td>14:00</td>
    <td>2</td>
		<td>1</td>
    <td>Toto</td>
    <td>Titi</td>
	</tr>
  </tr><tr>
    <td>08/06</td>
    <td>14:00</td>
    <td>3</td>
    <td>3</td>
    <td>Gaga</td>
    <td>Gogo</td>
  </tr>
  </tr><tr>
    <td>09/06</td>
    <td>16:00</td>
    <td>4</td>
    <td>5</td>
    <td>Lux</td>
    <td>Garen</td>
  </tr>
</tbody></table>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

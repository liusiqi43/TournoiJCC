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
			<td><a href="./matchs_files/matchs.htm">2008</a></td>
			<td><a href="./matchs_files/matchs.htm">2009</a></td>
			<td><a href="./matchs_files/matchs.htm">2010</a></td>
			<td><a href="./matchs_files/matchs.htm">2011</a></td>
			<td><a href="./matchs_files/matchs.htm">2012</a></td>
		</tr>
	</tbody></table>
	
</div>
<h1>Classement</h1>
<h2>2009</h2>
<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Joueur</th>
    <th>Points</th>
    <th>Matchs joués</th>
		<th>Matchs gagnés</th>
    <th>Matchs perdus</th>
	</tr><tr>
		<td>Ahryus</td>
    <td>24</td>
    <td>8</td>
		<td>8</td>
    <td>0</td>
	</tr>
	<tr>
    <td>Sayanel</td>
    <td>20</td>
    <td>8</td>
		<td>6</td>
		<td>2</td>
	</tr>
  <tr>
    <td>Gagamaury</td>
    <td>20</td>
    <td>8</td>
    <td>6</td>
    <td>2</td>
  </tr>
  <tr>
    <td>Toto</td>
    <td>15</td>
    <td>7</td>
    <td>5</td>
    <td>2</td>
  </tr>
</tbody></table>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

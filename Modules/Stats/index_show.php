<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; ?>

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
<h1>Statistiques</h1>
<h2>2009</h2>
<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<th>Joueurs</th>
		<th>Matchs joués</th>
	</tr><tr>
		<td>40</td>
		<td>38</td>
	</tr>
	<tr>
		<td>56</td>
		<td>50</td>
	</tr>
  <tr>
    <td>48</td>
    <td>42</td>
  </tr>
  <tr>
    <td>60</td>
    <td>55</td>
  </tr>
</tbody></table>

<!-- footer -->
<?php require_once $ROOT.'footer.php';

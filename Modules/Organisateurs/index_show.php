<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; ?>

<h2>Les Organisateurs</h2>
<div style="float:right;">
	<table class="table text-right">
		<tbody><tr>
			<td><a href="#">2008</a></td>
			<td><a href="#">2009</a></td>
			<td><a href="#">2010</a></td>
			<td><a href="#">2011</a></td>
			<td><a href="#">2012</a></td>
		</tr>
	</tbody></table>
	
</div>
<h3>2010</h3>
<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Telephone</th>
			<th>Actions</th>
		</tr>
		<tr>
			<td>Dupond</td>
			<td>Martin</td>
			<td>06.00.00.00.01</td>
		<td><a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a>
		<a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
	</tr>
	<tr>
		<td>Belmart</td>
		<td>Pierre</td>
		<td>06.00.00.00.02</td>
		<td><a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a>
		<a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
	</tr>
	<tr>
		<td>Jorquet</td>
		<td>Jean</td>
		<td></td>
		<td><a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a>
		<a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
	</tr>
	<tr>
		<td>Mareco</td>
		<td>Maxime</td>
		<td>06.00.00.00.04</td>
		<td><a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a>
		<a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
	</tr>
</tbody></table>

<p class="button-row">
	<a href="#" class="btn btn-success"><i class="icon-plus icon-white"></i>Ajouter un organisateur</a>
</p>

<!-- footer -->
<?php require_once $ROOT.'footer.php';
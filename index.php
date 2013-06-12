<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">
  <?php if (!isset($ROOT)) $ROOT = './'; ?>
	<?php include("header.php") ?>
      <div class="hero-unit">
        <h1>Bienvenue à la Tournoi de JCC <?php date_default_timezone_set("Europe/Paris"); echo date("Y"); ?>!</h1>
        <br>
        <p>Sur ce site, vous pouvez consulter le planning, le classement des joueurs, contacter les organisateurs et plus!</p>
        <p style="float:right">(JCC: Jeu de Cartes à Collectionner)</p>
        <p><a href="Modules/Infos/index_show.php" class="btn btn-primary btn-large">En savoir+ &raquo;</a></p>
      </div>

      <div class="row">
        <div class="span4">
          <h2>Prochainement</h2>
          <!-- <p>Ici y aura les infos de prochaine match</p> -->
          <table class="table table-striped table-hover">
            <th><td>Joueur A</td><td>Joueur B</td><td>Date</td><td>Horaire</td></th>
            <tr><td></td><td>Simon</td><td>Siqi</td><td>05/05/2013</td><td>18:30</td></tr>
            <tr><td></td><td>Hugo</td><td>Siqi</td><td>05/05/2013</td><td>18:30</td></tr>
            <tr><td></td><td>Hugo</td><td>Pierre</td><td>05/05/2013</td><td>18:30</td></tr>
            <tr><td></td><td>Pierre</td><td>Maxime</td><td>05/05/2013</td><td>18:30</td></tr>
            <tr><td></td><td>Hugo</td><td>Maxime</td><td>05/05/2013</td><td>18:30</td></tr>
          </table>
          <p><a class="btn" href="#">En details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Top 10 Joueurs</h2>
          <!-- <p></p> -->
          <table class="table table-striped table-hover">
            <th><td>Gagne</td><td>Perdu</td></th>
            <tr class="success"><td>Simon</td><td>10</td><td>50</td></tr>
            <tr class="success"><td>Pierre</td><td>10</td><td>40</td></tr>
            <tr><td>Hugo</td><td>10</td><td>30</td></tr>
            <tr><td>Maxime</td><td>10</td><td>20</td></tr>
            <tr class="warning"><td>Siqi</td><td>10</td><td>10</td></tr>
          </table>
          <p><a class="btn" href="#">En details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Recherche Instantanée!</h2>
          <div class="well">
            <form>
                <fieldset>
                  <label>Joueur:</label>
                  <input type="text" class="span2" placeholder="Entrez le nom du joueur" data-provide="typeahead" data-items="4" data-source="[&quot;Siqi Liu&quot;,&quot;Pierre Lemaire&quot;,&quot;Hugo Trotignon&quot;,&quot;Maxime Daragon&quot;,&quot;Simon Inconnu&quot;]"
                  >
                  <label>Organisateur:</label>
                  <input type="text" class="span2" placeholder="Entrez le nom du joueur" data-provide="typeahead" data-items="4" data-source="[&quot;Siqi Liu&quot;,&quot;Pierre Lemaire&quot;,&quot;Hugo Trotignon&quot;,&quot;Maxime Daragon&quot;,&quot;Simon Inconnu&quot;]"
                  >
                  <label>Match:</label>
                  <input type="text" class="span2" id="dpMatch" placeholder="Entrez la date du match">
                  <p><button type="submit" class="btn">Go!</button></p>
                </fieldset>
            </form>
          </div>
        </div>
      </div>

      <hr>

	<?php include("footer.php") ?>


<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">
  <?php if (!isset($ROOT)) $ROOT = './'; ?>
	<?php include("header.php") ?>
  <?php require_once 'index_actions.php'; ?>


      <div class="hero-unit">
        <h1>Bienvenue au Tournoi <?php date_default_timezone_set("Europe/Paris"); echo date("Y"); ?> de <br>"Science : The Scattering" !</h1>
        <br>
        <p>Consultez le planning, le classement des joueurs, et toutes les infos du tournoi !</p>
        <!--<p style="float:right">(JCC: Jeu de Cartes à Collectionner)</p>-->
        
        <?php if(!isset($_SESSION['logged_in'])){
            echo "<p class =\"pull-right\"><a href=\"#myModal\" data-toggle=\"modal\">Inscription</a><p>";
          }
        ?>

        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Inscription</h3>
            </div>
            <div class="modal-body">
              <form action="index_register.php" method="POST" class="form-horizontal">
                <div class="control-group">
                  <label class="control-label" for="input-login">Login : </label>
                  <div class="controls">
                    <input id="input-login" type="text" name="login" value="">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input-psw">Mot de passe : </label>
                  <div class="controls">
                    <input id="input-psw" type="password" name="psw" value="">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input-nom">Nom : </label>
                  <div class="controls">
                    <input id="input-nom" type="text" name="nom" value="">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input-prenom">Prénom : </label>
                  <div class="controls">
                    <input id="input-prenom" type="text" name="prenom" value="">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input-date">Date de naissance : </label>
                  <div class="controls">
                    <input id="input-date" type="date" name="date" value="">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input-adr">Adresse : </label>
                  <div class="controls">
                    <input id="input-adr" type="text" name="adr" value="">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="registering_asked" value="S'inscrire">
              </form>
              <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Fermer</button>
            </div>
        </div>
      <a href="Modules/Infos/index_show.php" class="btn btn-primary btn-large">En savoir+ &raquo;</a></p>
      </div>


      <div class="row">
        <div class="span4">
          <h2>Prochainement</h2>
         
          <table class="table table-striped table-hover">
            <tr>
              <th>Joueur 1</th>
              <th>Joueur 2</th>
              <th>Jour</th>
              <th>Horaire</th> 
            </tr>
            <?php while($card = pg_fetch_array($next_10_matchs)): ?>
              <tr>
                <td><?php echo $card[0]; ?></td>
                <td><?php echo $card[1]; ?></td>
                <td><?php echo $card[2]; ?></td>
                <td><?php echo $card[3]; ?></td>
              </tr>
            <?php endwhile ?>
          </table>
        </div>
        <div class="span4">
          <h2>Top 10 Joueurs</h2>
         
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
          <h2>Top 10 des cartes</h2>
         
          <table class="table table-striped table-hover">
            <tr>
              <th>Carte</th>
              <th>Decks</th>
            </tr>
            <?php while($card = pg_fetch_array($top_10_cards)): ?>
              <tr>
                <td><?php echo $card[0]; ?></td>
                <td><?php echo $card[1]; ?></td>
              </tr>
            <?php endwhile ?>
          </table>
        </div>
      </div>

      <hr>

	<?php include("footer.php") ?>


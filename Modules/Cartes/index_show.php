<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once 'index_show_actions.php';
require_once $ROOT.'header.php'; ?>


<!-- //////////////////////////////////////////////// -->
<!-- TITRE DE LA PAGE -->
<!-- //////////////////////////////////////////////// -->


<?php if($_SESSION["droit"] == 2) //si organisateur
        echo "<h2>Banque des cartes</h2>";
    else
        echo "<h2>Mes cartes</h2>"; //si joueur
?>

<!-- //////////////////////////////////////////////// -->
<!-- JOUEUR : boutons des annes -->
<!-- //////////////////////////////////////////////// -->

<?php if($_SESSION['droit']==1){ //joueur AFFICHER LES ANNEES (en haut à droite)
    echo "<div style=\"float:right;\">";
        echo "<table class=\"table text-right\">";
            echo "<tbody>";
                echo "<tr>";
                    foreach ($annees as $a):
                        echo "<td><a href=\"?annee=$a\">$a</a></td>";
                    endforeach;
            echo "</tr>";
        echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<h3>".$annee."</h3>";
    }
?>

<!-- //////////////////////////////////////////////// -->
<!-- /// MODULES DIVERS -->
<!-- //////////////////////////////////////////////// -->


<?php if (isset($error)): ?>
    <?php echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error."</strong></div>"; ?>
<?php elseif(isset($_SESSION['last_error_msg'])): ?>
    <?php echo "<div class=\"alert alert-danger fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$db->last_error_msg()."</strong></div>"; ?>
<?php endif; ?>

<!-- ///////////////////////////////////////////// -->
<!-- ///  ORGANISATEUR : MODIFICATION D'UNE CARTE -->
<!-- ///////////////////////////////////////////// -->

<?php if (isset($action) && $action=="modify"): ?>
    <div class="alert alert-info fade in" style="padding:40px">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <form action="update_success.php" method="POST">
            <h3>Modification d'une carte</h3>

            <?php if($_GET["type"] == 'invention'):?>
            <input type="hidden" name="type" value="invention">

            <?php if(isset($newFaculte)){ // LA CARTE N'AVAIT PAS DE FACULTE : on passe la valeur own_faculte=new
                echo "<input type=\"hidden\" name=\"own_faculte\" value=\"new\">";
            }else{ // LA CARTE AVAIT UNE FACULTE : on passe la valeur own_faculte=old
                echo "<input type=\"hidden\" name=\"own_faculte\" value=\"old\">";
            } ?>

            <table class="table table-striped">           
                    <tr>
                        <td>Nom:&nbsp&nbsp</td><td><input type="text" name="nom" readonly value="<?php echo $card_to_modify->nom; ?>"></td>
                    </tr>
                    <tr>
                        <td>ExtentionStS:&nbsp&nbsp</td><td><input type="text" name="extensionsts" value="<?php echo $card_to_modify->extensionsts; ?>"></td>
                    </tr>
                    <tr>
                        <td>Attaque:&nbsp&nbsp</td><td><input type="text" name="attaque" value="<?php echo $card_to_modify->potentielattaque; ?>"></td>
                    </tr>
                    <tr>
                        <td>Defense:&nbsp&nbsp</td><td><input type="text" name="defense" value="<?php echo $card_to_modify->potentieldefense; ?>"></td>
                    </tr>
                    <tr>
                        <td>Coût en ressources:&nbsp&nbsp</td><td><input type="text" name="coutressource" value="<?php echo $card_to_modify->coutressource; ?>"></td>
                    </tr>
                    <tr>
                        <td>Faculté:&nbsp&nbsp</td><td><input type="text" name="faculte" value="<?php if(isset($faculte_to_modify)) echo $faculte_to_modify[0]; ?>"></td>
                    </tr>
                <tr>
                    <td></td><td><input type="submit" class="btn btn-success pull-right" name="update_card_submit" value="Valider"></td>
                </tr>
            </table>
            <?php endif ?>

            <?php if($_GET["type"] == 'effet'):?>
            <input type="hidden" name="type" value="effet">
            <table class="table table-striped">           
                    <tr>
                        <td>Nom:&nbsp&nbsp</td><td><input type="text" name="nom" readonly value="<?php echo $card_to_modify->nom; ?>"></td>
                    </tr>
                    <tr>
                        <td>ExtentionStS:&nbsp&nbsp</td><td><input type="text" name="extensionsts" value="<?php echo $card_to_modify->extensionsts; ?>"></td>
                    </tr>
                    <tr>
                        <td>Coût en ressources:&nbsp&nbsp</td><td><input type="text" name="coutressource" value="<?php echo $card_to_modify->coutressource; ?>"></td>
                    </tr>
                    <tr>
                        <td>Faculté:&nbsp&nbsp</td><td><input type="text" name="faculte" value="<?php if(isset($faculte_to_modify)) echo $faculte_to_modify[0]; ?>"></td>
                    </tr>
                <tr>
                    <td></td><td><input type="submit" class="btn btn-success pull-right" name="update_card_submit" value="Valider"></td>
                </tr>
            </table>
            <?php endif ?>

            <?php if($_GET["type"] == 'ressource'):?>
            <input type="hidden" name="type" value="effet">
            <table class="table table-striped">           
                    <tr>
                        <td>Nom:&nbsp&nbsp</td><td><input type="text" name="nom" readonly value="<?php echo $card_to_modify->nom; ?>"></td>
                    </tr>
                    <tr>
                        <td>ExtentionStS:&nbsp&nbsp</td><td><input type="text" name="extensionsts" value="<?php echo $card_to_modify->extensionsts; ?>"></td>
                    </tr>
                    <tr>
                        <td>Quantité de ressources:&nbsp&nbsp</td><td><input type="text" name="nbpoints" value="<?php echo $card_to_modify->nbpoints; ?>"></td>
                    </tr>
                    <tr>
                        <td>Faculté:&nbsp&nbsp</td><td><input type="text" name="faculte" value="<?php if(isset($faculte_to_modify)) echo $faculte_to_modify[0]; ?>"></td>
                    </tr>
                <tr>
                    <td></td><td><input type="submit" class="btn btn-success pull-right" name="update_card_submit" value="Valider"></td>
                </tr>
            </table>
            <?php endif ?>


        </form>
    </div>
<?php endif ?>
 
<!-- ///////////////////////////////////////////// -->
<!-- ///  ORGANISATEUR : AJOUT D'UNE CARTE A LA BDD -->
<!-- ///////////////////////////////////////////// -->

<?php if (isset($action) && $action=="new"): ?>
    <div class="alert alert-info fade in" style="padding:40px">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <form action="update_success.php" method="POST">
            <h3>Ajout d'une nouvelle carte</h3>

            <?php if($_GET["new"] == 'invention'):?>
                <input type="hidden" name="type" value="invention">
                <table class="table table-striped">
                    <tr>
                        <td>Nom:&nbsp&nbsp</td><td><input type="text" name="nom" value=""></td>
                    </tr>
                    <tr>
                        <td>ExtensionStS:&nbsp&nbsp</td><td><input type="text" name="extensionsts" value=""></td>
                    </tr>
                    <tr>
                        <td>Attaque:&nbsp&nbsp</td><td><input type="text" name="attaque" value="0"></td>
                    </tr>
                    <tr>
                        <td>Defense:&nbsp&nbsp</td><td><input type="text" name="defense" value="0"></td>
                    </tr>
                    <tr>
                        <td>Coût en ressources:&nbsp&nbsp</td><td><input type="text" name="coutressource" value="0"></td>
                    </tr>
                    <tr>
                        <td>Faculté:&nbsp&nbsp</td><td><input type="text" name="faculte" value=""></td>
                    </tr>
                    <tr>
                        <td></td><td><input type="submit" class="btn btn-success pull-right" name="add_new_card_submit" value="Valider"></td>
                    </tr>
                </table>
            <?php endif ?>

            <?php if($_GET["new"] == 'effet'):?>
                <input type="hidden" name="type" value="effet">
                <table class="table table-striped">
                    <tr>
                        <td>Nom:&nbsp&nbsp</td><td><input type="text" name="nom" value=""></td>
                    </tr>
                    <tr>
                        <td>ExtensionStS:&nbsp&nbsp</td><td><input type="text" name="extensionsts" value=""></td>
                    </tr>
                    <tr>
                        <td>Coût en ressources:&nbsp&nbsp</td><td><input type="text" name="coutressource" value="0"></td>
                    </tr>
                    <tr>
                        <td>Faculté:&nbsp&nbsp</td><td><input type="text" name="faculte" value=""></td>
                    </tr>
                    <tr>
                        <td></td><td><input type="submit" class="btn btn-success pull-right" name="add_new_card_submit" value="Valider"></td>
                    </tr>
                </table>
            <?php endif ?>

            <?php if($_GET["new"] == 'ressource'):?>
                <input type="hidden" name="type" value="ressource">
                <table class="table table-striped">
                    <tr>
                        <td>Nom:&nbsp&nbsp</td><td><input type="text" name="nom" value=""></td>
                    </tr>
                    <tr>
                        <td>ExtensionStS:&nbsp&nbsp</td><td><input type="text" name="extensionsts" value=""></td>
                    </tr>
                    <tr>
                        <td>Quantité de ressources:&nbsp&nbsp</td><td><input type="text" name="nbpoints" value=""></td>
                    </tr>
                    <tr>
                        <td>Faculté:&nbsp&nbsp</td><td><input type="text" name="faculte" value=""></td>
                    </tr>
                    <tr>
                        <td></td><td><input type="submit" class="btn btn-success pull-right" name="add_new_card_submit" value="Valider"></td>
                    </tr>
                </table>
            <?php endif ?>

        </form>
    </div>
<?php endif ?>


<!-- ///////////////////////////////////////////// -->
<!-- ///  JOUEUR : AJOUTER UNE CARTE A SON DECK -->
<!-- ///////////////////////////////////////////// -->

<?php if (isset($action) && $action == "add"):?> 
    <div class="row">
        <div class="span6">
            <h3>Ajout d'une carte au deck</h3>
            <form action="update_success.php" method="POST">
                <table>
                    <tr>

                        <?php if($_GET["add"]=='invention'){ // JOUEUR : AJOUTER UNE CARTE INVENTION

                        echo "<td>Cartes invention:&nbsp&nbsp</td>";
                        echo "<td>";
                            echo "<select name=\"nom\">";
                        
                                foreach ($cartes_affichage as $card_to_add):
                                    $variable = $card_to_add['nom'];
                                    echo "<option value= \"$variable\">$variable</option>";
                                endforeach;
                            echo "</select>";
                        echo "</td>";

                        } ?>

                        <?php if($_GET["add"]=="effet"){ // JOUEUR : AJOUTER UNE CARTE EFFET

                        echo "<td>Cartes effet:&nbsp&nbsp</td>";
                        echo "<td>";
                            echo "<select name=\"nom\">";
                        
                                foreach ($cartes_affichage as $card_to_add):
                                    $variable = $card_to_add['nom'];
                                    echo "<option value= \"$variable\">$variable</option>";
                                endforeach;
                            echo "</select>";
                        echo "</td>";

                        } ?>

                        <?php if($_GET["add"]=="ressource"){ // JOUEUR : AJOUTER UNE CARTE RESSOURCE

                        echo "<td>Cartes ressource:&nbsp&nbsp</td>";
                        echo "<td>";
                            echo "<select name=\"nom\">";
                        
                                foreach ($cartes_affichage as $card_to_add):
                                    $variable = $card_to_add['nom'];
                                    echo "<option value=\"$variable\">$variable</option>";
                                endforeach;
                            echo "</select>";
                        echo "</td>";

                        } ?>

                    </tr>
                <tr>
                    <td></td><td><input type="submit" class="btn btn-success pull-right" name="add_card_submit" value="Valider"></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
<?php endif ?>

<!-- //////////////////////////////////////////////// -->
<!-- /// TABLES DES CARTES -->
<!-- //////////////////////////////////////////////// -->

<!-- TABLES DES CARTES INVENTIONS -->
<h3>Inventions</h3>
<table class="table table-striped table-hover">
    <tbody>
        <tr>
            <th>Nom</th>
            <th>Extension</th>
            <?php if ($_SESSION["droit"]==2): ?>
                <th>Date de bannissement</th>
            <?php endif ?>
            <th>Attaque</th>
            <th>Défense</th>
            <th>Coût en ressources</th>
            <?php if ($admin): ?>
            <th>Actions</th>
            <?php endif ?>
        </tr>
    <?php foreach ($cartes_invention as $carte): ?>
    <tr <?php if($carte->dateinterdite != ""){ echo "style='color:red;'"; } ?> >
        <td><?php echo $carte->nom; ?></td>
        <td><?php echo $carte->extensionsts; ?></td>
        <?php if ($_SESSION["droit"]==2): ?>
            <td><?php echo "$carte->dateinterdite"; ?></td>
        <?php endif ?>
        <td><?php echo $carte->potentielattaque; ?></td>
        <td><?php echo $carte->potentieldefense; ?></td>
        <td><?php echo $carte->coutressource; ?></td>
        <?php if ($admin): ?>
            <td>
                <?php if ($_SESSION["droit"]==2 && $carte->dateinterdite != "") echo "<a href=\"?annee=$annee&allow='$carte->nom'\" class=\"btn btn-success\"><i class=\"icon-ok-sign icon-white\"></i></a>"; ?>
                <?php if ($_SESSION["droit"]==2 && $carte->dateinterdite == "") echo "<a href=\"?annee=$annee&ban='$carte->nom'\" class=\"btn btn-inverse\"><i class=\"icon-remove-sign icon-white\"></i></a>"; ?>
                <?php if ($_SESSION["droit"]==2) echo "<a href=\"?annee=$annee&modify='$carte->nom'&type=invention\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i></a>"; ?>
                <?php echo "<a href=\"?annee=$annee&delete='$carte->nom'&type=invention\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a>"; ?>
            </td>
        <?php endif ?>
    </tr>
<?php endforeach ?>
</tbody></table>

<?php if ($admin): ?>
    <!-- // utilisateur est org de l'annee courant, il peut donc modifie -->
    <?php if($_SESSION['droit']==2){ //ORAGNISATEUR
            echo "<p class=\"button-row\">";
                echo "<a href=\"?annee=$annee&new=invention\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i>Ajouter une carte</a>";
            echo "</p>";
        }else{ //JOUEUR
            echo "<p class=\"button-row\">";
                echo "<a href=\"?annee=$annee&add=invention\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i>Ajouter une carte</a>";
            echo "</p>";
        }
    ?>
<?php endif; ?>



<!-- TABLES DES CARTES EFFETS -->
<h3>Effets</h3>
<table class="table table-striped table-hover">
    <tbody>
        <tr>
            <th>Nom</th>
            <th>Extension</th>
            <?php if ($_SESSION["droit"]==2): ?>
                <th>Date de bannissement</th>
            <?php endif ?>
            <th>Coût en ressources</th>
            <?php if ($admin): ?>
            <th>Actions</th>
            <?php endif ?>
        </tr>
    <?php foreach ($cartes_effet as $carte): ?>
    <tr <?php if($carte->dateinterdite != ""){ echo "style='color:red;'"; } ?> >
        <td><?php echo $carte->nom; ?></td>
        <td><?php echo $carte->extensionsts; ?></td>
        <?php if ($_SESSION["droit"]==2): ?>
            <td><?php echo "$carte->dateinterdite"; ?></td>
        <?php endif ?>
        <td><?php echo $carte->coutressource; ?></td>
        <?php if ($admin): ?>
            <td>
                <?php if ($_SESSION["droit"]==2 && $carte->dateinterdite != "") echo "<a href=\"?annee=$annee&allow='$carte->nom'\" class=\"btn btn-success\"><i class=\"icon-ok-sign icon-white\"></i></a>"; ?>
                <?php if ($_SESSION["droit"]==2 && $carte->dateinterdite == "") echo "<a href=\"?annee=$annee&ban='$carte->nom'\" class=\"btn btn-inverse\"><i class=\"icon-remove-sign icon-white\"></i></a>"; ?>
                <?php if ($_SESSION["droit"]==2) echo "<a href=\"?annee=$annee&modify='$carte->nom'&type=effet\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i></a>"; ?>
                <?php echo "<a href=\"?annee=$annee&delete='$carte->nom'&type=effet\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a>"; ?>
            </td>
        <?php endif ?>
    </tr>
<?php endforeach ?>
</tbody></table>

<?php if ($admin): ?>
    <!-- // utilisateur est org de l'annee courant, il peut donc modifie -->
    <?php if($_SESSION['droit']==2){ //ORAGNISATEUR
            echo "<p class=\"button-row\">";
                echo "<a href=\"?annee=$annee&new=effet\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i>Ajouter une carte</a>";
            echo "</p>";
        }else{ //JOUEUR
            echo "<p class=\"button-row\">";
                echo "<a href=\"?annee=$annee&add=effet\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i>Ajouter une carte</a>";
            echo "</p>";
        }
    ?>
<?php endif; ?>


<!-- TABLES DES CARTES RESSOURCES -->
<h3>Ressources</h3>
<table class="table table-striped table-hover">
    <tbody>
        <tr>
            <th>Nom</th>
            <th>Extension</th>
            <?php if ($_SESSION["droit"]==2): ?>
                <th>Date de bannissement</th>
            <?php endif ?>
            <th>Quantité</th>
            <?php if ($admin): ?>
            <th>Actions</th>
            <?php endif ?>
        </tr>
    <?php foreach ($cartes_ressource as $carte): ?>
    <tr <?php if($carte->dateinterdite != ""){ echo "style='color:red;'"; } ?> >
        <td><?php echo $carte->nom; ?></td>
        <td><?php echo $carte->extensionsts; ?></td>
        <?php if ($admin): ?>
            <td><?php echo "$carte->dateinterdite"; ?></td>
        <?php endif ?>
        <td><?php echo $carte->nbpoints; ?></td>
        <?php if ($admin): ?>
            <td>
                <?php if ($_SESSION["droit"]==2 && $carte->dateinterdite != "") echo "<a href=\"?annee=$annee&allow='$carte->nom'\" class=\"btn btn-success\"><i class=\"icon-ok-sign icon-white\"></i></a>"; ?>
                <?php if ($_SESSION["droit"]==2 && $carte->dateinterdite == "") echo "<a href=\"?annee=$annee&ban='$carte->nom'\" class=\"btn btn-inverse\"><i class=\"icon-remove-sign icon-white\"></i></a>"; ?>
                <?php if ($_SESSION["droit"]==2) echo "<a href=\"?annee=$annee&modify='$carte->nom'&type=ressource\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i></a>"; ?>
                <?php echo "<a href=\"?annee=$annee&delete='$carte->nom'&type=ressource\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a>"; ?>
            </td>
        <?php endif ?>
    </tr>
<?php endforeach ?>
</tbody></table>

<?php if ($admin): ?>
    <!-- // utilisateur est org de l'annee courant, il peut donc modifie -->
    <?php if($_SESSION['droit']==2){ //ORAGNISATEUR
            echo "<p class=\"button-row\">";
                echo "<a href=\"?annee=$annee&new=ressource\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i>Ajouter une carte</a>";
            echo "</p>";
        }else{ //JOUEUR
            echo "<p class=\"button-row\">";
                echo "<a href=\"?annee=$annee&add=ressource\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i>Ajouter une carte</a>";
            echo "</p>";
        }
    ?>
<?php endif; ?>




<!-- footer -->
<?php require_once $ROOT.'footer.php';

?>

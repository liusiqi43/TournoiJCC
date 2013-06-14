<!-- header.php -->
<?php
require_once $ROOT.'global.inc.php';
require_once $ROOT.'model/logintools.class.php';
//check to see if they've submitted the login form
if(isset($_POST['submit-login'])) { 

  $username = $_POST['login'];
  $password = $_POST['psw'];
  $error = "";

  $loginTools = new LoginTools();
  if($loginTools->login($username, $password)){
  }else{
    $error = "Buzz!! You can only log in if you are organisateur and you have correct login+pwd";
    echo "<div class=\"alert fade in\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><strong>".$error."</strong></div>";
  }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Tournoi de JCC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo $ROOT; ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $ROOT; ?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo $ROOT; ?>assets/css/tournoi.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo $ROOT; ?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $ROOT; ?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $ROOT; ?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $ROOT; ?>assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo $ROOT; ?>assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?php echo $ROOT; ?>assets/ico/favicon.png">
  </head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo $ROOT; ?>index.php">Tournoi de JCC</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="<?php echo $ROOT; ?>Modules/Classement/index_show.php">Classement</a></li>
              <li><a href="<?php echo $ROOT; ?>Modules/Planning/index_show.php">Planning</a></li>
              <li><a href="<?php echo $ROOT; ?>Modules/Stats/index_show.php">Stats</a></li>
              <?php if (isset($_SESSION['logged_in'])): ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionnaires<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php if ($_SESSION['droit'] == 2): ?>
                    <li><a href="<?php echo $ROOT; ?>Modules/Organisateurs/index_show.php">Organisateur</a></li>
                    <li><a href="<?php echo $ROOT; ?>Modules/Joueurs/index_show.php">Joueur</a></li>
                    <li><a href="<?php echo $ROOT; ?>Modules/Matches/index_show.php">Match</a></li>
                  <?php endif ?>
                  <li><a href="<?php echo $ROOT; ?>Modules/Cartes/index_show.php">Cartes</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Besoin d'aide?</li>
                  <li><a href="mailto:me@siqi.fr"><i class="icon-envelope icon-black"></i> Support</a></li>
                </ul>
              </li>
              <?php endif; ?>
              <li><a href="<?php echo $ROOT; ?>Modules/Infos/index_show.php">En Savoir+</a></li>
            </ul>
          <?php if (!isset($_SESSION['logged_in'])): ?>
            <form class="navbar-form pull-right" action="<?php echo $ROOT; ?>index.php" method="post">
              <input class="span2" type="text" placeholder="Login" name="login">
              <input class="span2" type="password" placeholder="Password" name="psw">
              <button type="submit" class="btn" name="submit-login">Sign in</button>
            </form>
          <?php else:?>
            <?php $member = unserialize($_SESSION['member']); ?>
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#drop-connexion">
                <i class="icon-user"></i> <?php echo $member->login ?>                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo $ROOT; ?>logout.php">Logout</a></li>
              </ul>
            </div>
          <?php endif ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  <div class="container"> 

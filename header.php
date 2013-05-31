<!-- header.php -->

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
              <li><a href="#ranking">Classement</a></li>
              <li><a href="#schedule">Planning</a></li>
              <li><a href="#schedule">Stats</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionnaires<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Organisateur</a></li>
                  <li><a href="<?php echo $ROOT; ?>Modules/Joueurs/index_show.php">Joueur</a></li>
                  <li><a href="#">Match</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Besoin d'aide?</li>
                  <li><a href="mailto:me@siqi.fr"><i class="icon-envelope icon-black"></i> Support</a></li>
                </ul>
              </li>
              <li><a href="#about">En Savoir+</a></li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  <div class="container"> 

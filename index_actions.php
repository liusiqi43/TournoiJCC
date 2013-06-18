<?php

date_default_timezone_set("Europe/Paris");
$annee =  date("Y");
$today = date("Y-m-d");

$top_10_cards = $db->exec_sql("SELECT nom, count(*) FROM tdecks GROUP BY nom ORDER BY count(*) DESC, nom LIMIT 10;");

$next_10_matchs = $db->exec_sql("SELECT j1, j2, jour, horaire FROM tmatchs WHERE victoire=0 AND annee_tournoi=$annee ORDER BY jour DESC LIMIT 10;");
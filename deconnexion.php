<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
//cette commande passe le time du cookie a -1 donc il est suprimmer du navigateur
setcookie('sid','', -1);
$_SESSION['notification']['result'] = 'danger';
$_SESSION['notification']['message'] = 'Vous etes déconnecté';

//apres ce traitement on retourne a l'index 
header("Location: index.php");
exit();


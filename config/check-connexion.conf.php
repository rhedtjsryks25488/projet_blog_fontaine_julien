<?php
//FICHIER PHP QUI VERIFIE SI LE COKKIE DE CONNEXION EST VALIDE 
require_once 'bdd.conf.php';
 //print_r2($_COOKIE);
if (isset($_COOKIE['sid'])) {
    $sid = $_COOKIE['sid'];
    $utilisateurManager = new utilisateurManager($bdd);
    $utilisateurConnecte = $utilisateurManager->getBySid($sid);
    if ($utilisateurConnecte->getEmail() != '') {
        $utilisateurConnecte->isConnect = true;
    } else {
        $utilisateurConnecte->isConnect = false;
    }
   // print_r2($utilisateurConnecte);
} else {
    $utilisateurConnecte = new utilisateur();
    $utilisateurConnecte->isConnect = false;
    //print_r2($utilisateurConnecte);
}
?> 
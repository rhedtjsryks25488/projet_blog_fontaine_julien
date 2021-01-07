<?php
//system de session
//AJOUTE LES COOKIES
session_start();

//Affichage des erreurs et avertissements PHP
error_reporting(E_ALL);
ini_set("display_error", 1);

define('nb_articles_par_page', 2);

//Fonction debug POUR VOIR LES ERREURS 
function print_r2($tab_a_afficher_print_r) {
    echo '<pre>';
    print_r($tab_a_afficher_print_r);
    echo '</pre>';
}

//INITIALISE LES CLASSES 
function loadClass($class) {
    if (is_file("classes/".$class.".class.php")){
        require_once("classes/".$class.".class.php");
    }
}


//appel les classes 
spl_autoload_register("loadClass");

require_once 'check-connexion.conf.php';
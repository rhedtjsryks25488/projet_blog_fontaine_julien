<?php
//FICHIER PHP DE CONNEXION A LA BASE DE DONNEE 
try {
    $bdd = new PDO('mysql:host=localhost;dbname=dev;charset=utf8', 'root', '');
    $bdd->exec("set names utf8");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}  


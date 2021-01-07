<?php

//créer une classe pour le commentaire
class commentaireManager {

//DECLARATIONS ET INSTANCIATIONS
    private $bdd; //Instance de PDO
    private $_result;
    private $_message;

    // initialiser la base de doonnée 
    public function __construct(PDO $bdd) {
        $this->setBdd($bdd);
    }
//ajouter les geter et seter 
    function getBdd() {
        return $this->bdd;
    }

    function get_result() {
        return $this->_result;
    }

    function get_message() {
        return $this->_message;
    }

    function setBdd($bdd): void {
        $this->bdd = $bdd;
    }

    function set_result($_result): void {
        $this->_result = $_result;
    }

    function set_message($_message): void {
        $this->_message = $_message;
    }

    public function afficherCommentaires($commentaire) {
        $retour = "";
        //aller chercher le texte du commentaire quand c'est l' id  concerné
        $requete = $bdd->prepare("SELECT txt FROM commentaire  WHERE articles_id =  :commentaire");
        $requete->bindValue(":commentaire", $commentaire, PDO::PARAM_INT);
        $requete->execute();

        while ($donnees = $requete->fetch()) {
            $retour .= "<div>article ici</div>";
        }

        return $retour;
    }

    public function insererCommentaire($commentaire, $txt) {
        $requete = $bdd->prepare("INSERT INTO commentaire (usr, txt, articles_id) VALUES (:usr, :txt, :articles_id)");
        $requete->bindValue(":usr", $usr, PDO::PARAM_INT);
        $requete->bindValue(":txt", $text, PDO::PARAM_STR);
        $requete->bindValue(":articles_id", $articles_id, PDO::PARAM_INT);
        if ($requete->execute())
            return TRUE;
        return FALSE;
    }

}

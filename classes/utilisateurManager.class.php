<?php

class utilisateurManager {

    private $bdd; //Instance de PDO
    private $_result;
    private $_message;
    private $_utilisateur;
    private $_getLastInsertId;

    public function __construct(PDO $bdd) {
        $this->setBdd($bdd);
    }

    function getBdd() {
        return $this->bdd;
    }

    function get_result() {
        return $this->_result;
    }

    function get_message() {
        return $this->_message;
    }

    function get_utilisateur() {
        return $this->_utilisateur;
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

    function set_utilisateur($_utilisateur): void {
        $this->_utilisateur = $_utilisateur;
    }

    //private $_utilisateur;

    public function add(utilisateur $utilisateur) {
        $sql = "INSERT INTO utilisateurs "
                . "(nom, prenom, email, mdp, sid) "
                . "VALUES (:nom, :prenom, :email, :mdp, :sid)";

        $req = $this->bdd->prepare($sql);
        //secur variable
        $req->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $utilisateur->getMdp(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateur->getSid(), PDO::PARAM_STR);
        //exec sql
        $req->execute();

        //retour erreur
        if ($req->errorCode() == 00000) {
            $this->_result = true;
            $this->_getLastInsertId = $this->bdd->lastInsertId();
        } else {
            $this->_result = false;
        }
        return $this;
    }

    public function getByEmail($email) {
        //prepare une requete sql select 
        $sql = 'SELECT * FROM utilisateurs WHERE email = :email';
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $user = new utilisateur();
        $user->hydrate($donnees);

        return $user;
    }

    public function getBySid($sid) {
        //prepare une requete sql select 
        $sql = 'SELECT * FROM utilisateurs WHERE sid = :sid';
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':sid', $sid, PDO::PARAM_STR);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $user = new utilisateur();
        $user->hydrate($donnees);

        return $user;
    }

    public function updateByEmail(utilisateur $utilisateur) {
        $sql = "UPDATE utilisateurs SET sid = :sid WHERE email = :email";

        $req = $this->bdd->prepare($sql);

        $req->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateur->getSid(), PDO::PARAM_STR);

        $req->execute();

        if ($req->errorCode() == 00000) {
            $this->_result = true;
        } else {
            $this->_result = false;
        }
        return $this;
    }

   

}

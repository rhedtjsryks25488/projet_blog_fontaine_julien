<?php

class commentaire {

    public $id;
    public $usr;
    public $txt;
    public $article_id;

    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getUsr() {
        return $this->usr;
    }

    function getTxt() {
        return $this->txt;
    }

    function getArticleid() {
        return $this->article_id;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setUsr($usr): void {
        $this->usr = $usr;
    }

    function setTxt($txt): void {
        $this->txt = $txt;
    }

    function setArticleid($article_id): void {
        $this->article_id = $article_id;
    }

    // initialise les données a traité 
    public function hydrate($donnees) {
        if (isset($donnees['id'])) {
            $this->id = $donnees['id'];
        } else {
            $this->id = '';
        }

        if (isset($donnees['usr'])) {
            $this->usr = $donnees['usr'];
        } else {
            $this->usr = '';
        }

        if (isset($donnees['txt'])) {
            $this->txt = $donnees['txt'];
        } else {
            $this->txt = '';
        }

        if (isset($donnees['article_id'])) {
            $this->article_id = $donnees['article_id'];
        } else {
            $this->article_id = '';
        }
    }

}

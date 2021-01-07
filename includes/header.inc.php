<!DOCTYPE html>
<!-- HAUT DE PAGE -->
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Mon Blog</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="#">Julien FONTAINE</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php
                        //affiche les elements suivants si l'utilisateur a un session valide de connexion
                        if ($utilisateurConnecte->isConnect == true) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="article.php">Créer un article</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="createuser.php">Créer un utilisateur</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                            </li>
                            
                            <?php
                        }
                        ?>
                        <?php
                        //affiche les elements suivants si l'utilisateur n'as pas une session valide de connexion
                        if ($utilisateurConnecte->isConnect == false) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion.php">Connexion</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <form class="form-inline" id="rechercheForm" method="GET" action="recherche.php" >
                <label class="sr-only" for="recherche">Recherche</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="recherche" placeholder="Rechercher un article" name="recherche" value="">
                <button type="submit" class="btn btn-primary mb-2" name="submitRecherche">Rechercher</button>
            </form>             

        </nav>
<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';


if (isset($_POST['submit'])) {
    echo 'utilisateur créer';
// initialisation de la variable utilisateur et de la classe utilisateur
    $utilisateur = new utilisateur();
    $utilisateur->hydrate($_POST);

   //variable qui crypte le mot de passe pour qu'il ne soit pas en clair dans l'envoie du formulaire
    $utilisateur->setMdp(password_hash($utilisateur->getMdp(), PASSWORD_DEFAULT));
    //insersion de l'utilisateur
    $utilisateurManager = new utilisateurManager($bdd);
    $utilisateurManager->add($utilisateur);

    
//créer une session qui valide l'injection sql
    if ($utilisateurManager->get_result() == true) {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'utilisateur créer avec réussite !';
    } else {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'Une erreur est survenue pendant la création de l utilisateur';
    }
    
//retour a l'écrand d'acceuil 
    header("Location: index.php");
//exit();
} else {
    //formulaire de création d'utilisateur
    include_once 'includes/header.inc.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Création d'un nouvel utilisateur</h1>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form id="utilisateurForm" method="POST" action="createuser.php" enctype="multipart/form-data">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="" placeholder="" required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nom">Prenom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="" placeholder="" required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nom">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="" placeholder="" required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="texte">Mot de passe</label>
                            <input type="password" id="mdp" name="mdp" class="form-control" value="" placeholder="" required>
                        </div>
                    </div>


                    <!-- bouton qui envoie le formulaire a php (_POST)grace a son name sumbit  -->
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Créer mon nouvel utilisateur</button>   
                </form>
            </div>
        </div>
    </div>


    <?php
    include_once 'includes/footer.inc.php';
}
?>
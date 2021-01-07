<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
//print_r2($_session);



//traitement php pour verifier email et mot de passe depuis la base de donnée
if (isset($_POST['submit'])) {

    //initialisation de la variable utilisateur et de la classe utilisateur
    $utilisateur = new utilisateur();
    $utilisateur->hydrate($_POST);

    //initialisation de la variable utilisateur et de la classe utilisateurmanager et de sa fonction bdd
    $utilisateurManager = new utilisateurManager($bdd);
    //recuperation de l'émail grace a la variable utilisateurEnBdd qui recuperer le getEmail
    $utilisateurEnBdd = $utilisateurManager->getByEmail($utilisateur->getEmail());

    //utilise la fonction native de php pour verifier le mot de passe md5
    $isConnect = password_verify($utilisateur->getMdp(), $utilisateurEnBdd->getMdp());

// si l'utilisateur et connecter création d'un cookie de connexion de 86400 sec
    if ($isConnect == true) {
        $sid = md5($utilisateur->getEmail() . time());
        setcookie('sid', $sid, time() + 86400);
        $utilisateur->setSid($sid);
        $utilisateurManager->updateByEmail($utilisateur);
    }

//créer une session qui valide l'injection sql
    //apres connextion réussi retour sur la page d'index sinon message d'erreur et redirection sur la page de connexion
    if ($isConnect == true) {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'connexion réussi !';
        header("Location: index.php");
    } else {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'verifier login mot de passe';
        header("Location: connexion.php");
    }
    //stop l'execution php de conexion (if (isset($_POST['submit'])))
    exit();
} // page de traitement pour entrer mail et mdp 
    else {
    //formulaire de création d'utilisateur
    include_once 'includes/header.inc.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Connexion utilisateur</h1>
            </div>
        </div>

        <?php if (isset($_SESSION['notification'])) { ?>

            <!-- verifie la session -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-<?= $_SESSION['notification']['result'] ?>" role="alert">
                        <?= $_SESSION['notification']['message'] ?>
                    </div>
                </div>
            </div>
            <!-- tuer la session -->
            <?php
            unset($_SESSION['notification']);
        }
        ?>
            <!-- FORMULAIRE DE CONNEXION -->
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form id="utilisateurForm" method="POST" action="connexion.php" enctype="multipart/form-data">



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



                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Se connecter</button>   
                </form>
            </div>
        </div>
    </div>


    <?php
    include_once 'includes/footer.inc.php';
}
?>
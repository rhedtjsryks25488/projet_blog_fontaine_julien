<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
//include_once 'commentaireManager.class.php';
//include_once 'commentaire.class.php';


if ($utilisateurConnecte->isConnect == false) {
    $_SESSION['notification']['result'] = 'danger';
    $_SESSION['notification']['message'] = 'vous devez etre connecté';
    header("Location: connexion.php");
    exit();
}

//a partir de la page index.php quand l'on clique sur "consulter" alors ca nous mene a cette page en recuperant l'id
if (isset($_GET['action']) AND $_GET['action'] == 'article' AND $_GET["id"] AND is_numeric($_GET["id"])) {

    include_once 'includes/header.inc.php';
    // ici on appel et initialise la classe articleManager
    $articleManager = new articleManager($bdd);
    $article = $articleManager->get($_GET["id"]);
    // ici on appel et initialise la classe commentaireManager
   
    //traitement du post du commentaire
//if (isset($_POST['commentaire'])) {
    //echo 'le commentaire est posté';
    //$commentaire = new article();
    //$commentaire->hydrate($_POST);
    //$commentaire->setTxt($txt);
    //insersion du commentaire
    ///$commentaireManager = new commentaireManager($bdd);
    //$commentaireManager->add($commentaire);
    ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- ici on appel le titre de l'article grace a la variable $article et au numéro de l'id -->
                <h1 class="mt-5">Article: <?= $article->titre; ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form id="articleForm" method="GET" action="consult.php" enctype="multipart/form-data">


                    <div class="col-lg-12">
                        <div class="form-group">
                            <!-- ici on appel le texte de l'article grace a la variable $article et au numéro de l'id -->
                            <a><?= $article->texte; ?></a>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <!-- ici on appel l'image de l'article grace a la variable $article et au numéro de l'id -->
                            <img src="img/image<?= $article->id; ?>.jpg" class="w-100"/>
                        </div>
                    </div>    

                    <input type="hidden" name="id" value="<?= $article->id; ?>"/>
                </form>
            </div>
        </div>


        <br/><br/>

        <div class="col">
            <form>
                <div class="form-group">
                    <label for="input-commentaire">Ajouter un commentaire</label>
                    <textarea class="form-control" rows="3" name="commentaire" id="input-commentaire" placeholder="Ecrivez ici..."></textarea>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

        <div class="col">
            <form>
                <div class="form-group">
                    <label for="input-commentaire">Liste des commentaires</label>
                    <!-- <a><? //= $commentaire->txt;    ?></a> -->
                </div>
            </form>
        </div>
    </div> 


    <?php
    //ici on ferme la balise php car si on la ferme plus tot le traitement ne se fait pas et le php contenu dans le html ne s'execute pas
}
//}
?>
      
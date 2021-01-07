<?php
// initialiser smarty 
// $smarty = new Smarty();
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
//print_r2($_session);

if ($utilisateurConnecte->isConnect == false) {
    $_SESSION['notification']['result'] = 'danger';
    $_SESSION['notification']['message'] = 'vous devez etre connecté';
    header("Location: connexion.php");
    exit();
}



// TRAITEMENT POUR RECUPERER LES INFOS DE MON ARTICLE ET POUR LE MODIFIER 
if (isset($_GET['action']) AND $_GET['action'] == 'modifier' AND $_GET["id"] AND is_numeric($_GET["id"])) {

    include_once 'includes/header.inc.php';
    // ici on appel et initialise la classe articleManager
   $articleManager = new articleManager($bdd);
   $article = $articleManager->get($_GET["id"]);
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Modifier mon article</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form id="articleForm" method="POST" action="article.php" enctype="multipart/form-data">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <!-- on recupere le titre de l'article grace au numéro d'id et de la fonction bdd qui vas prendre le titre-->
                            <input type="text" id="titre" name="titre" class="form-control" value="<?= $article->titre; ?>" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="texte">Le texte de mon article</label>
                            <!-- on recupere le texte de l'article grace au numéro d'id et de la fonction bdd qui vas prendre le texte -->
                            <textarea class="form-control" id="texte" name="texte" rows="3" required><?= $article->texte; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="image">L'image de mon article</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            <!-- ici grace a l'id recuperer par la fonction add d'articlemanager on peut afficher l'image qui a le numéro d'id a la fin -->
                            <img src="img/image<?= $article->id; ?>.jpg" class="w-100"/>
                        </div>
                    </div>    
                    <div class="col-lg-12">
                        <div class="form-group form-check">
                            <!-- ici on recupere l'état 0 ou 1 grace a la fonction add d'articleManager -->
                            <input type="checkbox" class="form-check-input" id="publie" name="publie" value="1"<?php if ($article->publie) echo 'checked'; ?>>
                            <label class="form-check-label" for="publie"> Article publié ?</label>
                        </div>
                    </div>    
                    <!-- on envoie ensuite le formulaire et avec le 'name="modification"' php va poster sur la base de donnée  -->
                    <button type="submit" id="submit" name="modification" class="btn btn-primary">Mettre à jour mon article</button>
                    
                    <input type="hidden" name="id" value="<?= $article->id; ?>"/>
                </form>
            </div>
        </div>
    </div>
    <?php
}
else {

    if (isset($_POST["modification"]) AND $_POST["id"]) {
        
        
        //initialisation d'articleManager et de la fonction bdd
        $articleManager = new articleManager($bdd);
        $article = $articleManager->get($_POST["id"]);
        
        //envoie le titre et le texte 
        if ($_POST["titre"]) $article->setTitre($_POST["titre"]);
        if ($_POST["texte"]) $article->setTexte($_POST["texte"]);

        //si rien n'est coché alors l'article ne sera pas publié sinon la variable _POST vas passé a l'état publie
        if ($_POST["publie"] == 1) $article->setPublie($_POST["publie"]);
        else $article->setPublie(0);
        
        //format de la date
        $article->setDate(date('Y-m-d'));
        
        //appel de la fonction update d'article manager
        $update = $articleManager->update($article);

        if ($_FILES AND $_FILES['image']['error'] == 0) {
            $fileInfos = pathinfo($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . 'image' . $update->get_getLastInsertId() . '.' . $fileInfos['extension']);
        }
        
        
        //affiche un resultat pour l'utilisateur if(ok) else(non ok retour a l'index)
        if ($update->get_result()) {
            $_SESSION['notification']['result'] = 'success';
            $_SESSION['notification']['message'] = "Votre article « {$_POST['titre']} » a été modifié !";
        }
        else {
            $_SESSION['notification']['result'] = 'danger';
            $_SESSION['notification']['message'] = 'Une erreur est survenue pendant la modification de votre article.';
        }

        header("Location: index.php");
        
    }
    
    //TRAITEMENT POUR CREER UN ARTICLE 
    else {
        
        if (isset($_POST['creation'])) {
            echo 'le formulaire est posté';

            $article = new article();
            $article->hydrate($_POST);
            $article->setDate(date('Y-m-d'));
            
            $publie = intval($article->getPublie()) == 1 ? 1 : 0;

            $article->setPublie($publie);

            //insersion de l'article
            $articleManager = new articleManager($bdd);
            $articleManager->add($article);

            //Traité l'image
            if ($_FILES AND $_FILES['image']['error'] == 0) {
                //rename l'image uploded
                $fileInfos = pathinfo($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . 'image' . $articleManager->get_getLastInsertId() . '.' . $fileInfos['extension']);
            }

            //créer une session
            if ($articleManager->get_result()) {
                $_SESSION['notification']['result'] = 'success';
                $_SESSION['notification']['message'] = 'votre article a ete ajouté !';
            } else {
                $_SESSION['notification']['result'] = 'danger';
                $_SESSION['notification']['message'] = 'Une erreur est survenue pendant la création de votre article';
            }

            header("Location: index.php");
            exit();
        }
        else {
            //echo 'aucun formulaire est posté';
            include_once 'includes/header.inc.php';
            ?>

        <!-- FORMULAIRE POUR CRER UN ARTICLE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="mt-5">Créer un nouvel article</h1>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <form id="articleForm" method="POST" action="article.php" enctype="multipart/form-data">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="titre">Titre</label>
                                    <input type="text" id="tite" name="titre" class="form-control" value="" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="texte">Le texte de mon article</label>
                                    <textarea class="form-control" id="texte" name="texte" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="image">L'image de mon article</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>
                            </div>    
                            <div class="col-lg-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" checked class="form-check-input" id="publie" name="publie" value="1">
                                    <label class="form-check-label" for="publie"> Article publié ?</label>
                                </div>
                            </div>    
                            <button type="submit" id="submit" name="creation" class="btn btn-primary">Créer mon article</button>   
                        </form>
                    </div>
                </div>
            </div>


            <?php
            include_once 'includes/footer.inc.php';
        }
    }
}
?>


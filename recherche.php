<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
include_once 'includes/header.inc.php';

if (isset($_GET['submitRecherche'])) {
    $recherche = $_GET['recherche'];
    $articleManager = new articleManager($bdd);
    $listeArticles = $articleManager->getListArticlesFromRecherche($recherche);

    include_once 'includes/header.inc.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">BLOG</h1>
                <p class="lead">Julien FONTAINE</p>
                <ul class="list-unstyled">
                    <li>LP ASR</li>
                    <li>DEV php sql</li>
                </ul>
            </div>
        </div>
        
        <?php if (isset($_SESSION['notification'])) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-<?= $_SESSION['notification']['result'] ?>" role="alert">
                        <?= $_SESSION['notification']['message'] ?>
                    </div>
                </div>
            </div>
            <?php
            unset($_SESSION['notification']);
        }
        ?>

        <div class="row">
            <?php
            //boucle qui recherche les articles et qui les mets dans un tableau consultable
            foreach ($listeArticles as $key => $article) {
                ?>
                <div class="col-md-6">
                    <div class="card" style="">
                        <img src="img/image<?= $article->getId(); ?>.jpg" class="card-img-top mx-auto d-block" alt="<?= $article->getTitre(); ?>" style="width:300px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article->getTitre(); ?></h5>
                            <p class="card-text"><?= substr($article->getTexte(), 0, 150) . '...'; ?></p>
                            <a href="#" class="btn btn-primary"><?= $article->getDate(); ?></a>
                            <?php if ($utilisateurConnecte->isConnect == true) { ?>
                                <a href="article.php?action=modifier&id=<?= $article->getId(); ?>" class="btn btn-warning">Modifier</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>        
    </div>
    <?php
    include_once 'includes/footer.inc.php';
} else {
    header("Location: index.php");
}
?>

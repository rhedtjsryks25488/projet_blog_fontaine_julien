<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';

//$articleManager = new articleManager($bdd);
//$newArticle = $articleManager->get(1);
//print_r2($newArticle);
//print_r2($_SESSION);


$page = !empty($_GET['p']) ? $_GET['p'] : 1;
//print_r2($page);
//echo nb_articles_par_page;
$articleManager = new articleManager($bdd);

$nbArticlesTotalAPublie = $articleManager->countArticlesPublie();
print_r2($nbArticlesTotalAPublie);

$indexDepart = ($page - 1) * nb_articles_par_page;
$nbPage = ceil($nbArticlesTotalAPublie / nb_articles_par_page);

$listArticles = $articleManager->getListArticlesAAfficher($indexDepart, nb_articles_par_page);
//print_r2($listArticles);


include_once 'includes/header.inc.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center mt-5">
            <form class="form-inline" id="rechercheForm" method="GET" action="recherche.php" >
                <label class="sr-only" for="recherche">Recherche</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="recherche" placeholder="Rechercher un article" name="recherche" value="">
                <button type="submit" class="btn btn-primary mb-2" name="submitRecherche">Rechercher</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Julien FONTAINE</h1>
            <p class="lead">Bienvenu sur mon BLOG</p>
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

    <div class="row">
        <?php
        foreach ($listArticles as $key => $article) {
            ?>
            <div class="col-md-6">
                <div class="card" style="">
                    <img src="img/image<?= $article->getId(); ?>" class="card-img-top" alt="<?= $article->getTitre(); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->getTitre(); ?></h5>
                        <p class="card-text"><?= $article->getTexte(); ?></p>
                        <a href="#" class="btn btn-primary"><?= $article->getDate(); ?></a>
                        <a id="modifier" href="article.php?action=modifier&id=<?= $article->getId(); ?>" class="btn btn-primary"> modifier article</a>
                        <a id="modifier" href="consult.php?action=article&id=<?= $article->getId(); ?>" class="btn btn-primary"> consulter article</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>



    </div>
    <div class="row mt-3">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    for ($index = 1; $index <= $nbPage; $index++) {
                        ?>
                        <li class="page-item <?php if ($page == $index) { ?>active <?php } ?>"> <a class="page-link" href="index.php?p=<?= $index ?>"><?= $index ?> </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
include_once 'includes/footer.inc.php';
?>

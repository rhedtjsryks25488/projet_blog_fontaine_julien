<?php
require_once 'config/config.inc.php';
require_once 'config/bdd.conf.php';
require_once('components/smarty/libs/Smarty.class.php');
//print_r2($_SESSION);
//$article = new article();
//$article->hydrate(array());
//print_r2($article);

$page = !empty($_GET['p']) ? $_GET['p'] : 1;

$articleManager = new articleManager($bdd);

$nbArticlesTotalAPublie = $articleManager->countArticlesPublie();
//print_r2($nbArticlesTotalAPublie);

$indexDepart = ($page - 1) * nb_articles_par_page;

$nbPages = ceil($nbArticlesTotalAPublie / nb_articles_par_page);

$listeArticles = $articleManager->getListArticlesAAfficher($indexDepart, nb_articles_par_page);
//print_r2($listeArticles);
//exit();

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

$smarty->assign('listeArticles', $listeArticles);
$smarty->assign('utilisateurConnecte', $utilisateurConnecte);
$smarty->assign('nbPages', $nbPages);
$smarty->assign('page', $page);


include_once 'includes/header.inc.php';

$smarty->display('index.tpl');

include_once 'includes/footer.inc.php';

unset($_SESSION['notification']);
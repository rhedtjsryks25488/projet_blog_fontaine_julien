<?php

require_once 'config/config.inc.php';
require_once 'components/smarty/libs/Smarty.class.php';

$prenom = "Julien";

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates/');

$smarty->assign('prenom', $prenom);


$smarty->display('exempleSmarty.tpl');
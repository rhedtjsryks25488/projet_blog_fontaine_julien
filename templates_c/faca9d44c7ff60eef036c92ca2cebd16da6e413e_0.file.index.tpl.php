<?php
/* Smarty version 3.1.34-dev-7, created on 2021-01-05 19:07:35
  from 'C:\wamp64\www\asrprojet\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ff4b8f797dc40_88211313',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faca9d44c7ff60eef036c92ca2cebd16da6e413e' => 
    array (
      0 => 'C:\\wamp64\\www\\asrprojet\\templates\\index.tpl',
      1 => 1609873653,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff4b8f797dc40_88211313 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">BLOG </h1>
            <p class="lead">Julien FONTAINE</p>
            <ul class="list-unstyled">
                <li>LP ASR</li>
                <li>Dev php sql</li>
            </ul>
        </div>
    </div>
    <?php if ((isset($_SESSION['notification']))) {?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-<?php echo $_SESSION['notification']['result'];?>
" role="alert">
                    <?php echo $_SESSION['notification']['message'];?>

                </div>
            </div>
        </div>
    <?php }?>
    <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listeArticles']->value, 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
            <div class="col-md-6">
                <div class="card" style="">
                    <img src="img/image<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
.jpg" class="card-img-top mx-auto d-block" alt="<?php echo $_smarty_tpl->tpl_vars['article']->value->getTitre();?>
" style="width:300px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['article']->value->getTitre();?>
</h5>
                        <p class="card-text"><?php echo substr($_smarty_tpl->tpl_vars['article']->value->getTexte(),0,150);?>
...</p>
                        <a href="#" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['article']->value->getDate();?>
</a>
                        <?php if ($_smarty_tpl->tpl_vars['utilisateurConnecte']->value->isConnect == true) {?>
                            <a href="article.php?action=modifier&id=<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
" class="btn btn-warning">Modifier</a>
                        <?php }?>
                        <a href="consult.php?action=article&id=<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
" class="btn btn-warning">consulter</a>
                        
                    </div>
                </div>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? $_smarty_tpl->tpl_vars['nbPages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nbPages']->value)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 1, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration === 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration === $_smarty_tpl->tpl_vars['index']->total;?>
                        <li class="page-item <?php if (($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['index']->value)) {?>active<?php }?>"><a class="page-link" href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</a></li>
                        <?php }
}
?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php }
}

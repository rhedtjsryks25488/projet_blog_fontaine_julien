<!-- Page Content -->
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
    {if isset($smarty.session.notification)}
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-{$smarty.session.notification.result}" role="alert">
                    {$smarty.session.notification.message}
                </div>
            </div>
        </div>
    {/if}
    <div class="row">
        {foreach from=$listeArticles item=$article}
            <div class="col-md-6">
                <div class="card" style="">
                    <img src="img/image{$article->getId()}.jpg" class="card-img-top mx-auto d-block" alt="{$article->getTitre()}" style="width:300px">
                    <div class="card-body">
                        <h5 class="card-title">{$article->getTitre()}</h5>
                        <p class="card-text">{substr($article->getTexte(), 0, 150)}...</p>
                        <a href="#" class="btn btn-primary">{$article->getDate()}</a>
                        {if $utilisateurConnecte->isConnect == true}
                            <a href="article.php?action=modifier&id={$article->getId()}" class="btn btn-warning">Modifier</a>
                        {/if}
                        <a href="consult.php?action=article&id={$article->getId()}" class="btn btn-warning">consulter</a>
                        
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {for $index=1 to $nbPages}
                        <li class="page-item {if ($page == $index)}active{/if}"><a class="page-link" href="index.php?p={$index}">{$index}</a></li>
                        {/for}
                </ul>
            </nav>
        </div>
    </div>
</div>

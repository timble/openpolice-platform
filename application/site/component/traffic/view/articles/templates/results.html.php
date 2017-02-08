<?= import('com:news.view.article.metadata.html', array('article' => $category)) ?>

<h1 class="article__header"><?= translate('Roadside safety check results'); ?></h1>

<? if(count($articles)) : ?>
    <table class="table table--striped">
        <tbody>
        <? foreach ($articles as $article) : ?>
            <tr>
                <td nowrap>
                    <?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
                </td>
                <td width="100%">
                    <? if($article->text) : ?>
                    <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= escape($article->title) ?></a>
                    <? else : ?>
                    <?= escape($article->title) ?>
                    <? endif ?>
                    <div class="text--small text--muted">
                        <? if ($article->isLocatable() && $streets = $article->getStreets()) : ?>
                            <?= implode(", ", $streets->title) ?>
                        <? else : ?>
                            <?= translate('Territory Police').' '.object('com:police.model.zone')->id(object('application')->getCfg('site' ))->getRow()->title ?>
                        <? endif ?>
                    </div>
                </td>
                <td nowrap>
                    <? $in_violation = $article->in_violation ? round(($article->in_violation / $article->controlled) * 100, 0) : 0 ?>
                    <?= (100 - $in_violation); ?> %
                    <span><?= strtolower(translate('In line')) ?></span>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
<? else : ?>
    <h2 class="text-center" style="padding-top: 20px"><?= @translate('No results') ?></h2>
<? endif ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>

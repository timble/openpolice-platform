<?= import('com:news.view.article.metadata.html', array('article' => $category)) ?>

<h1 class="article__header"><?= translate('Roadside safety check results'); ?></h1>

<? if(count($articles)) : ?>
    <table class="table table--striped">
        <thead>
            <tr>
                <th width="100%"></th>
                <th nowrap><?= @translate('In violation') ?></th>
                <th nowrap><?= @translate('Date') ?></th>
            </tr>
        </thead>
        <tbody>
        <? foreach ($articles as $article) : ?>
            <tr>
                <td>
                    <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= escape($article->title) ?></a><br />
                    <small>
                        <? if ($article->isLocatable() && $streets = $article->getStreets()->title) : ?>
                            <?= implode(", ", $article->getStreets()->title) ?>
                        <? else : ?>
                            <?= translate('Territory Police').' '.object('com:police.model.zone')->id(object('application')->getCfg('site' ))->getRow()->title ?>
                        <? endif ?>
                    </small>
                </td>
                <td>
                    <?= round(($article->in_violation / $article->controlled) * 100, 0); ?> %
                </td>
                <td>
                    <?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
<? else : ?>
    <h2 class="text-center" style="padding-top: 20px"><?= @translate('No results') ?></h2>
<? endif ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
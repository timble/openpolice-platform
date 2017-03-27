<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?= import('com:news.view.article.metadata.html') ?>

<title content="replace"><?= escape($article->title) ?></title>

<div class="article" itemprop="event" itemscope itemtype="http://schema.org/Event">
    <header class="article__header">
        <h1 itemprop="name"><?= escape($article->title) ?></h1>
        <div class="text--small">
            <?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
        </div>
    </header>
    <div class="article__text">
    <? if($article->text) : ?>
        <div<?= count($streets) || ($article->controlled && $article->in_violation) ? ' class="traffic__text"' : '' ?>>
            <span itemprop="description"><?= $article->text ?></span>
        </div>
    <? endif ?>

    <? if(isset($streets) || ($article->controlled)) : ?>
        <div<?= $article->text ? ' class="traffic__sidebar"' : '' ?>>
            <? if($article->controlled) : ?>
                <div<?= $article->text ? ' class="well"' : '' ?>>
                    <strong><?= translate('Results') ?>:</strong>
                    <ul>
                        <li><?= translate('Controlled') ?>: <?= $article->controlled ?></li>
                        <li><?= translate('In line') ?>: <?= $article->controlled - $article->in_violation ?></li>
                    </ul>
                </div>
            <? endif ?>

            <? if(isset($streets)) : ?>
                <div<?= $article->text ? ' class="well"' : '' ?>>
                    <strong><?= translate('Streets') ?>:</strong>
                    <ul>
                        <? foreach ($streets as $street) : ?>
                            <li><?= $street->title ?></li>
                        <? endforeach; ?>
                    </ul>
                </div>
            <? endif ?>
        </div>
    <? endif ?>
    </div>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array(false))) ?>
</div>

<script src="assets://application/components/jquery/dist/jquery.min.js" />
<script src="assets://application/components/magnific-popup/dist/jquery.magnific-popup.min.js" />
<script data-inline>
    $(document).ready(function() {
        // This will create a single gallery from all elements that have class data-gallery="enabled"
        $('[data-gallery="enabled"]').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    });
</script>

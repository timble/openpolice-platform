<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= import('com:news.view.article.metadata.html') ?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= escape($article->title) ?></title>

<div class="article" itemprop="event" itemscope itemtype="http://schema.org/Event">
    <header class="article__header">
        <h1 itemprop="name"><?= escape($article->title) ?></h1>
        <div class="timestamp">
            <?= helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
        </div>
    </header>

    <? if($article->isStreetable()) : ?>
        <? if(count($streets = $article->getStreets())) : ?>
            <? if($article->text) : ?>
            <div class="well" style="float: right; margin-left: 30px">
                <strong><?= translate('Streets') ?>:</strong>
            <? endif ?>
                <ul>
                <? foreach ($streets as $street) : ?>
                    <li><?= $street->street ?></li>
                <? endforeach; ?>
                </ul>
            <? if($article->text) : ?>
            </div>
            <? endif ?>
        <? endif ?>
    <? endif ?>

    <? if($article->text) : ?>
        <span itemprop="description"><?= $article->text ?></span>
    <? endif ?>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array(false))) ?>
</div>

<script src="assets://application/components/jquery/jquery.min.js" />
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
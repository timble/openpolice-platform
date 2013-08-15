<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:'91c73e48-a5e0-43ea-988f-57d099f878c7'});</script>

<article>
    <div class="page-header clearfix">
        <h1><?= $article->title ?></h1>
        <span class="timestamp">
            <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
        </span>
        <span style="float:right" class='st_sharethis' displayText='ShareThis'></span>
    </div>

    <?= @helper('com:attachments.image.thumbnail', array('row' => $article)) ?>

    <div class="article__introtext"><?= $article->introtext ?></div>
    <?= $article->fulltext ?>

    <?= @template('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>
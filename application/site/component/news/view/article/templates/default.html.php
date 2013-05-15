<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<? $site = @object('application')->getCfg('site') ?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:'91c73e48-a5e0-43ea-988f-57d099f878c7'});</script>

<ktml:module position="left">
    <h3><i class="icon-question-sign"></i> Vragen</h3>
    <p>Meer weten over cybercrime of drugs? Of wat de politie doet tegen woninginbraak?</p>
    <p><a href="<?= $site ?>/vragen">Beantwoord uw vraag &rarr;</a></p>
    <h3><i class="icon-road"></i>Verkeer</h3>
    <p>Bent u opzoek naar informatie over controle acties of verkeersmaatregelen?</p>
    <p><a href="<?= $site ?>/verkeer">Bekijk verkeersinformatie &rarr;</a></p>
</ktml:module>

<div class="page-header clearfix">
    <h1><?= $article->title ?></h1>
    <span class="timestamp">
        <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
    </span>
    <span style="float:right" class='st_sharethis' displayText='ShareThis'></span>
</div>

<? if($article->thumbnail): ?>
    <img class="thumbnail" src="<?= $article->thumbnail ?>" align="right" style="margin:0 0 20px 20px;" />
<? endif; ?>

<?= $article->introtext ?>
<?= $article->fulltext ?>

<?= @template('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->image))) ?>

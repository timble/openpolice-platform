<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= import('com:news.view.article.metadata.html', array('article' => $question)) ?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= $question->title ?></title>

<article class="article">
    <h1 class="article__header"><?= escape($question->title); ?></h1>

    <? if($question->attachments_attachment_id) : ?>
    <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="article__thumbnail" href="attachments://<?= $thumbnail ?>" data-gallery="enabled">
    <?= helper('com:police.image.thumbnail', array(
        'attachment' => $question->attachments_attachment_id,
        'attribs' => array('width' => '400', 'height' => '300'))) ?>
    </a>
    <? endif ?>

    <?= $question->text ?>

    <?= import('com:news.view.article.default_youtube.html', array('youtube' => $question->params->get('youtube', false))) ?>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($question->attachments_attachment_id))) ?>
</article>

<? if(object('application')->getCfg('site') != '5396') : ?>
<?= import('com:questions.view.questions.default_contact.html') ?>
<? endif ?>

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
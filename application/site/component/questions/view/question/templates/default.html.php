<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= $question->title ?></title>

<article class="article">
    <h1 class="article__header"><?= escape($question->title); ?></h1>

    <?= helper('com:attachments.image.thumbnail', array(
        'attachment' => $question->attachments_attachment_id,
        'attribs' => array('width' => '400', 'height' => '300', 'class' => 'article__thumbnail'))) ?>

    <?= $question->text ?>
</article>

<?= import('com:questions.view.questions.default_contact.html') ?>

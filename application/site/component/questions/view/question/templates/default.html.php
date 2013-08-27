<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<title content="replace"><?= $question->title ?></title>

<article>
    <div class="page-header">
        <h1><?= escape($question->title); ?></h1>
    </div>

    <div class="clearfix">
        <?= helper('com:attachments.image.thumbnail', array('row' => $question)) ?>

        <?= $question->text ?>
    </div>
</article>

<?= import('com:questions.view.questions.default_contact.html') ?>

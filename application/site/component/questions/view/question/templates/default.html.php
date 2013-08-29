<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<ktml:module position="left">
    <?= import('com:questions.view.questions.default_categories.html', array('categories' => $categories, 'selected' => $state->category)) ?>
</ktml:module>

<title content="replace"><?= $question->title ?></title>

<article>
    <header>
        <h1><?= escape($question->title); ?></h1>
    </header>

    <?= helper('com:attachments.image.thumbnail', array('row' => $question)) ?>

    <?= $question->text ?>
</article>

<?= import('com:questions.view.questions.default_contact.html') ?>

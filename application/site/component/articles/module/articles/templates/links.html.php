<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if($show_title) : ?>
<h3><?= $module->title ?></h3>
<? endif ?>

<ul>
    <?php foreach ($articles as $article): ?>
    <li>
        <a href="<?php echo helper('com:articles.route.article', array('row' => $article)) ?>"><?php echo escape($article->title) ?></a>
    </li>
    <?php endforeach; ?>
</ul>
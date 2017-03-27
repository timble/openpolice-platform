<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<title content="replace"><?= $category->title ?></title>

<h1><?= $category->title ?></h1>

<ul class="categories_wrapper">
    <? foreach(object('com:articles.model.categories')->category($category->id)->getRowset() as $article) : ?>
        <li>
            <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= highlight($article->title) ?></a>
        </li>
    <? endforeach; ?>
    <? foreach ($articles as $article): ?>
    <li>
        <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= highlight($article->title) ?></a>
    </li>
    <? endforeach; ?>
</ul>

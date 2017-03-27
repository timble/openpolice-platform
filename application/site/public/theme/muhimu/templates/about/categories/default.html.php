<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h1><?= translate('About us') ?></h1>
<ul class="categories_wrapper">
<? foreach($categories as $category) : ?>
    <li>
        <a href="<?= helper('route.category', array('row' => $category)) ?>"><?= $category->title ?></a>
    </li>
<? endforeach; ?>
</ul>

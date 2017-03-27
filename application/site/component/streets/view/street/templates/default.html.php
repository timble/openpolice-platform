<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if($street->id) : ?>
<ktml:module position="left">
    <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $street->title ?>,Leuven,Belgium&zoom=12&size=200x400&maptype=roadmap
&markers=color:blue%7Clabel:S%7C<?= $street->title ?>,Leuven,Belgium&sensor=false">
</ktml:module>

<h1><?= $street->title ?></h1>

<? foreach(object('com:districts.model.relations')->street($street->id)->getRowset() as $district) : ?>
    <?=  object('com:districts.controller.district')->id($district->districts_district_id)->render(); ?>
<? endforeach ?>

<? $articles = object('com:traffic.model.articles')->street($street->id)->getRowset(); ?>

<? $categories = object('com:categories.model.categories')->table('traffic')->getRowset(); ?>

<? foreach($categories as $category) : ?>
    <? $items = $articles->find(array('categories_category_id' => $category->id)) ?>
    <? if(count($items)) : ?>
    <h2><?= $category->title ?></h2>
    <? foreach($items as $article) : ?>
        <h3>
            <?= helper('date.format', array('date'=> $article->start_on, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'dtstart'))) ?>
            <? if($article->end_on && ($article->end_on != $article->start_on)) : ?>
                <?= translate('till') ?>
                <?= helper('date.format', array('date'=> $article->end_on, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'dtend'))); ?>
            <? endif ?>

            <small>
                <?= escape($article->title) ?>
            </small>
        </h3>
        <?= $article->text ?>
    <? endforeach ?>
<? endif ?>
<? endforeach ?>
<? endif ?>

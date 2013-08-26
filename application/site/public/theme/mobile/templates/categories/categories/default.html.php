<?
/**
 * @package     Nooku_Server
 * @subpackage  Categories
 * @copyright	Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.nooku.org
 */
?>

<? $site = escape(object('application')->getCfg('site' )) ?>

<? if($state->table == 'contacts') : ?>
    <? $category = object('com:categories.model.category')->id('24')->getRow() ?>
    <article>
        <div class="page-header">
            <h1>
                <a href="/<?= $site ?>/contact/je-wijkinspecteur">
                    <?= $category->title ?>
                </a>
            </h1>
        </div>

        <? if($category->thumbnail) : ?>
            <a href="/<?= $site ?>/contact/je-wijkinspecteur">
                <figure>
                    <img src="" />
                </figure>
            </a>
        <? endif ?>

        <?= $category->description ?>

        <a href="/<?= $site ?>/contact/je-wijkinspecteur"><?= translate('Read more') ?></a>
    </article>
<? endif ?>

<? foreach($categories as $category) : ?>
    <article>
        <div class="page-header">
            <h1>
                <a href="<?= helper('route.category', array('row' => $category)) ?>">
                    <?= escape($category->title);?>
                </a>
            </h1>
        </div>

        <? if($category->thumbnail) : ?>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <figure>
                    <img src="<?= $category->thumbnail ?>" />
                </figure>
            </a>
        <? endif ?>

        <? if ($category->description) : ?>
            <?= $category->description; ?>
        <? endif; ?>

        <a href="<?= helper('route.category', array('row' => $category)) ?>"><?= translate('Read more') ?></a>
    </article>
<? endforeach; ?>


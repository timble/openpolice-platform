<?
/**
 * @package     Nooku_Server
 * @subpackage  Categories
 * @copyright	Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.nooku.org
 */
?>

<? $site = @escape(@object('application')->getCfg('site' )) ?>

<? if($state->table == 'contacts') : ?>
    <? $category = @object('com:categories.model.category')->id('30')->getRow() ?>
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
                <img class="article__thumbnail" src="" />
            </a>
        <? endif ?>

        <?= $category->description ?>

        <a href="/<?= $site ?>/contact/je-wijkinspecteur"><?= @text('Read more') ?></a>
    </article>
<? endif ?>

<? foreach($categories as $category) : ?>
    <article>
        <div class="page-header">
            <h1>
                <a href="<?= @helper('route.category', array('row' => $category)) ?>">
                    <?= @escape($category->title);?>
                </a>
            </h1>
        </div>

        <? if($category->thumbnail) : ?>
            <a href="<?= @helper('route.category', array('row' => $category)) ?>">
                <img class="article__thumbnail" src="<?= $category->thumbnail ?>" />
            </a>
        <? endif ?>

        <? if ($category->description) : ?>
            <?= $category->description; ?>
        <? endif; ?>

        <a href="<?= @helper('route.category', array('row' => $category)) ?>"><?= @text('Read more') ?></a>
    </article>
<? endforeach; ?>


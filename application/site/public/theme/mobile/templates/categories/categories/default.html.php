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
    <div class="article">
        <h1 class="article__header">
            <a href="/<?= $site ?>/contact/je-wijkinspecteur">
                <?= $category->title ?>
            </a>
        </h1>

        <?= $category->description ?>

        <a class="article__readmore" href="/<?= $site ?>/contact/je-wijkinspecteur"><?= translate('Read more') ?></a>
    </div>
<? endif ?>

<? foreach($categories as $category) : ?>
    <div class="article">
        <h1 class="article__header">
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= escape($category->title);?>
            </a>
        </h1>

        <? if($category->attachments_attachment_id) : ?>
        <a class="article__thumbnail" href="<?= helper('route.category', array('row' => $category)) ?>">
            <?= helper('com:attachments.image.thumbnail', array(
                'attachment' => $category->attachments_attachment_id,
                'attribs' => array('width' => '200', 'align' => 'right'))) ?>
        </a>
        <? endif ?>

        <? if ($category->description) : ?>
            <?= $category->description; ?>
        <? endif; ?>

        <a class="article__readmore" href="<?= helper('route.category', array('row' => $category)) ?>"><?= translate('Read more') ?></a>
    </div>
<? endforeach; ?>


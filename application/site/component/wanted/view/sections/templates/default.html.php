<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ktml:module position="left">
    <?= import('list.html') ?>
</ktml:module>

<? foreach($sections as $section) : ?>
    <div class="article">
        <h1 class="article__header">
            <a href="<?= helper('route.section', array('row' => $section)) ?>">
                <?= escape($section->title);?>
            </a>
        </h1>

        <?= import('com:wanted.view.articles.default_list.html', array('articles' => object('com:wanted.model.articles')->section($section->id)->limit('4')->published('1')->getRowset())) ?>

        <a class="article__readmore" href="<?= helper('route.section', array('row' => $section)) ?>"><?= translate('All section'.$section->id) ?></a>
    </div>
<? endforeach; ?>
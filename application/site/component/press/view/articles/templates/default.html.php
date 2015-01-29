<?
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <? $modules = object('com:pages.model.modules')->position('quicklinks')->published('true')->getRowset(); ?>

    <? foreach($modules as $module) : ?>
        <div class="sidebar__element">
            <h3><?= $module->title ?></h3>
            <?= $module->content ?>
        </div>
    <? endforeach ?>
</ktml:module>

<h1><?= escape(translate('Press')); ?></h1>

<table class="table table--striped">
    <thead>
        <tr>
            <th>
                <?= @translate('Title') ?>
            </th>
            <th>
                <?= @translate('Datum') ?>
            </th>
        </tr>
        </thead>
    <tbody>
        <? foreach ($articles as $article) : ?>
            <tr>
                <td><a href="<?= helper('route.article', array('row' => $article)) ?>"><?= escape($article->title) ?></a></td>
                <td nowrap><?= helper('date.format', array('date'=> $article->published_on, 'format' => translate('DATE_FORMAT_LC5'))) ?></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>

<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<title content="replace"><?= $category->title ?></title>

<link href="<?= route('format=rss') ?>" rel="alternate" type="application/rss+xml" />

<h1 class="article__header"><?= escape($params->get('page_title')); ?></h1>

<? if ($category->image || $category->description) : ?>
    <div class="clearfix">
        <? if ($category->image) : ?>
            <?= helper('com:categories.string.image', array('row' => $category)) ?>
        <? endif; ?>
        <?= $category->description; ?>
    </div>
<? endif; ?>

<table class="table table--striped">
    <thead>
    <tr>
        <th width="100%">
            <?= translate('Name'); ?>
        </th>
        <th>
            <?= translate('Phone'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <? foreach($contacts as $contact) : ?>
        <tr>
            <td>
                <a href="<?= helper('route.contact', array('row' => $contact)) ?>">
                    <?= $contact->title; ?>
                </a>
            </td>
            <td nowrap="nowrap">
                <?= escape($contact->telephone ? $contact->telephone : $contact->mobile); ?>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>


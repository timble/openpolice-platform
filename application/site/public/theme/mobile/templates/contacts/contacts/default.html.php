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
        <? if ($params->get('show_telephone', true)) : ?>
            <th>
                <?= translate('Phone'); ?>
            </th>
        <? endif; ?>
    </tr>
    </thead>
    <tbody>
        <? foreach($contacts as $contact) : ?>
        <tr>
            <td>
                <a href="<?= helper('route.contact', array('row' => $contact)) ?>">
                    <?= $contact->name; ?>
                </a>
            </td>
            <? if ($params->get('show_telephone', true)) : ?>
                <td nowrap="nowrap">
                    <?= escape($contact->telephone); ?>
                </td>
            <? endif; ?>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>

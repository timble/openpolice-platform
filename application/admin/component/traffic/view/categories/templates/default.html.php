<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->
<?= helper('behavior.sortable') ?>

<? if($categories->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages') ?>
</ktml:module>
<? endif ?>

<form action="" method="get" class="-koowa-grid">
    <input type="hidden" name="type" value="<?= $state->type;?>" />

    <?= import('com:categories.view.categories.default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <? if(isset($sortable)) : ?>
                <th class="handle"></th>
            <? endif ?>
            <th width="1">
                <?= helper('grid.checkall'); ?>
            </th>
            <th width="1"></th>
            <th>
                <?= helper('grid.sort',  array('column' => 'title')); ?>
            </th>
            <th width="1">
                <?= helper('grid.sort',  array( 'title' => 'Articles', 'column' => 'count')); ?>
            </th>
            <? if($categories->isTranslatable()) : ?>
                <th width="70">
                    <?= translate('Translation') ?>
                </th>
            <? endif ?>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <td colspan="13">
                <?= helper('com:application.paginator.pagination', array('total' => $total)); ?>
            </td>
        </tr>
        </tfoot>

        <tbody<? if(isset($sortable)) : ?> class="sortable"<? endif ?>>
        <? foreach( $categories as $category) :  ?>
            <tr>
                <? if(isset($sortable)) : ?>
                    <td class="handle">
                        <span class="text-small data-order"><?= $category->ordering ?></span>
                    </td>
                <? endif ?>
                <td align="center">
                    <?= helper( 'grid.checkbox' , array('row' => $category)); ?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $category, 'field' => 'published')) ?>
                </td>
                <td>
                    <a href="<?= route( 'view=category&id='.$category->id ); ?>">
                        <?= escape($category->title); ?>
                    </a>
                    <? if($category->access) : ?>
                        <span class="label label-important"><?= translate('Registered') ?></span>
                    <? endif; ?>
                </td>
                <td align="center">
                    <?= $category->count; ?>
                </td>
                <? if($category->isTranslatable()) : ?>
                    <td>
                        <?= helper('com:languages.grid.status', array(
                            'status'   => $category->translation_status,
                            'original' => $category->translation_original,
                            'deleted'  => $category->translation_deleted));
                        ?>
                    </td>
                <? endif ?>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>

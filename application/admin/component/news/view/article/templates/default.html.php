<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />
<script src="assets://news/js/jquery.datetimepicker.js" />
<style src="assets://news/css/jquery.datetimepicker.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<script src="assets://news/js/block.js" />

<script>
    window.addEvent('domready', function() {
        new News.Block({
            container: 'article-form',
            url: '<?= route('view=article') ?>',
            id: <?= $article->id ?>,
            token: '<?= $this->getObject('user')->getSession()->getToken() ?>',
            nextBlock: <?= count($article->blocks) ? max(array_keys((array) $article->blocks)) + 1 : '1'?>
        });
    });
</script>

<style>
    .is-hidden {
        display: none;
    }

    .block {
        border: 1px solid red;
        margin-bottom: 20px;
    }
</style>

<form action="" method="post" id="article-form" class="-koowa-form">
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="sticky" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $article->title ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on">Slug</span>
                <input type="text" name="slug" maxlength="255" value="<?= $article->slug ?>" />
            </div>
        </div>

        <a id="new" class="btn" href="#" data-action="new" style="margin: 20px 20px 0">New</a>
        <div id="blocks" style="padding: 20px">
            <? if(count($article->blocks)) : ?>
                <? foreach($article->blocks as $key => $value) : ?>
                    <?= $key ?>
                    <div id="block-<?= $key ?>" class="block" data-block="<?= $key ?>">
                        <h2 class="heading"><?= $value->heading ?></h2>
                        <div class="text">
                            <?= htmlspecialchars_decode($value->text) ?>
                        </div>
                        <div class="toolbar">
                            <a href="#" data-action="load" data-block="<?= $key ?>">Edit</a>
                        </div>
                    </div>
                <? endforeach ?>
            <? endif ?>
        </div>
    </div>

    <div id="sidebar" class="sidebar">
        <div id="editor" class="is-hidden">
            <input id="heading" type="text" name="heading" maxlength="255" placeholder="<?= translate('Heading') ?>" />
            <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => '')) ?>
            <input id="image" type="file" name="image" />
        </div>
        <a id="save" class="btn" href="#" data-action="save">Save</a>
    </div>

</form>
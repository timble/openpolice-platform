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
<?= helper('behavior.inline_editing'); ?>

<script src="assets://js/koowa.js" />
<script src="assets://news/js/jquery.datetimepicker.js" />
<style src="assets://news/css/jquery.datetimepicker.css" />

<script src="assets://news/js/block.js" />
<script src="assets://news/js/draggable.js" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

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

    .block .image {
        width: 50px;
        height: 50px;
        border: 1px solid green;
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

        <div id="blocks" style="padding: 20px; border: 1px solid blue">
            <? if(count($article->blocks)) : ?>
                <? foreach($article->blocks as $key => $value) : ?>
                    <?= $key ?>
                    <div id="block-<?= $key ?>" class="block" data-block="<?= $key ?>">
                        <h2 class="heading" contenteditable="true">
                            <?= $value->heading ?>
                        </h2>
                        <div class="text" contenteditable="true">
                            <?= htmlspecialchars_decode($value->text) ?>
                        </div>
                        <div id="div<?= $key ?>" class="image" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <?
                        if ($value->attachments_attachment_id) : ?>
                            <?
                            $thumbnail = $this->getObject('com:attachments.database.row.attachment')->set('id', $value->attachments_attachment_id)->load();
                        ?>
                            <img data-id="<?= $thumbnail->id ?>" src="files/<?= $this->getObject('application')->getSite() ?>/attachments/<?= $thumbnail->thumbnail ?>" />
                            <? endif ?>
                        </div>
                    </div>
                <? endforeach ?>
            <? endif ?>
        </div>
        <a id="new" class="btn" href="#" data-action="new" style="margin: 20px 20px 0">New</a>
        <a id="save" class="btn" href="#" data-action="save" style="margin: 20px 20px 0">Save</a>
    </div>

    <div id="sidebar" class="sidebar">
        <?= import('default_sidebar.html') ?>
    </div>
</form>
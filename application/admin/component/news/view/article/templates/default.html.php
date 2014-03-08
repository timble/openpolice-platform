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
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js" />

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

<script>
    $jQuery(function() {
        $jQuery( "#blocks" ).sortable({
            handle: '.handle',
            cursor: 'move' ,
            update: function(){
                // Refresh all CKEDITOR instances
                for (var instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].destroy();
                }
                CKEDITOR.inlineAll();
            }
        });
    });
</script>

<style>
    .block__content:before,
    .block__content:after {
        content: " ";
        display: table;
    }

    .block__content:after {
        clear: both;
    }

    #blocks > .block {
        border: 2px solid white;
        margin-bottom: 20px;
        padding: 20px;
    }

    #blocks > .block:hover {
        border-color: #0b55c4;
    }

    #blocks .block__content .image {
        width: 100px;
        height: 75px;
        border: 2px dotted #dcdcdc;

        float: right;
    }

    #blocks .block__toolbar {
        font-size: 2em;
        float: right;
    }

    #blocks .block__toolbar > a.handle:hover {
        cursor: move;
    }

    .blocks__toolbar {
        background-color: #F5F5F5;
        padding-bottom: 20px;
        margin: 0 20px;
        border-radius: 5px;
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

        <div class="scrollable">
            <div id="blocks" style="padding: 20px;">
                <? if(count($article->blocks)) : ?>
                    <? foreach($article->blocks as $key => $value) : ?>
                        <div id="block-<?= $key ?>" class="block group" data-block="<?= $key ?>">
                            <div class="block__content">
                                <h2 contenteditable="true">
                                    <?= $value->heading ?>
                                </h2>
                                <div id="image<?= $key ?>" class="image">
                                    <?
                                    if ($value->attachments_attachment_id) : ?>
                                        <?
                                        $thumbnail = $this->getObject('com:attachments.database.row.attachment')->set('id', $value->attachments_attachment_id)->load();
                                        ?>
                                        <img data-id="<?= $thumbnail->id ?>" src="files/<?= $this->getObject('application')->getSite() ?>/attachments/<?= $thumbnail->thumbnail ?>" />
                                    <? endif ?>
                                </div>
                                <div class="te" contenteditable="true">
                                    <?= htmlspecialchars_decode($value->text) ?>
                                </div>

                            </div>
                            <div class="block__toolbar">
                                <a class="handle">&#8597;</a>
                                <a class="delete" href="#" onclick="$jQuery(this).parent().parent().remove()" data-block="<?= $key ?>">&#x2716;</a>
                            </div>
                        </div>
                    <? endforeach ?>
                <? endif ?>
            </div>
            <div class="blocks__toolbar">
                <a id="new" class="btn" href="#" data-action="new" data-type="paragraphImage" style="margin: 20px 20px 0">New paragraph with image</a>
                <a id="new" class="btn" href="#" data-action="new" data-type="paragraph" style="margin: 20px 20px 0">New paragraph</a>
                <a id="save" class="btn" href="#" data-action="save" style="margin: 20px 20px 0">Save</a>
            </div>
        </div>
    </div>

    <div id="sidebar" class="sidebar">
        <?= import('default_sidebar.html') ?>
    </div>
</form>

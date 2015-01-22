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

<script src="assets://news/js/underscore.js" />
<script src="assets://news/js/trevor.js" />
<script src="assets://news/Eventable/eventable.js" />
<script src="assets://news/sir-trevor-js/sir-trevor.min.js" />
<style src="assets://news/sir-trevor-js/sir-trevor.css" />
<style src="assets://news/sir-trevor-js/sir-trevor-icons.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<script>
    window.addEvent('domready', function() {
        new News.Trevor({
            container: 'article-form',
            url: '<?= route('view=article') ?>',
            id: <?= $article->id ?>,
            token: '<?= $this->getObject('user')->getSession()->getToken() ?>'
        });
    });
</script>

<form action="" method="post" id="article-form" class="-koowa-form">
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="sticky" value="0" />
    <input type="hidden" name="attachments_attachment_id" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $article->title ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on">Slug</span>
                <input type="text" name="slug" maxlength="255" value="<?= $article->slug ?>" />
            </div>
        </div>

        <div class="scrollable">
            <textarea class="js-st-instance"><?= $article->content ?></textarea>
        </div>

        <div class="blocks__toolbar">
            <a id="save" class="btn" href="#" data-action="save" style="margin: 20px 20px 0">Save</a>
        </div>
    </div>

    <div id="sidebar" class="sidebar">
        <?= import('default_sidebar.html') ?>
    </div>
</form>

<script data-inline>
    new SirTrevor.Editor({ el: $jQuery('.js-st-instance') });
</script>
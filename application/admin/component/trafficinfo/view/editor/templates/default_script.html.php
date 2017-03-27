<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? /* Image and article buttons needs this in order to work */ ?>
<?= helper('behavior.modal') ?>

<style src="assets://com_wysiwyg/css/default.css" />

<? if ($options['toggle']) : ?>
    <style src="assets://com_wysiwyg/css/form.css" />
    <script src="assets://com_wysiwyg/js/Fx.Toggle.js" />
<? endif ?>

<script src="assets://com_wysiwyg/tinymce/tiny_mce<?= KDEBUG ? '_src.js' : '.js' ?>" />
<script src="assets://com_wysiwyg/js/Editor.js" />

<? if($codemirror) : ?>
<script src="assets://com_wysiwyg/codemirror/lib/codemirror.js" />
<script src="assets://com_wysiwyg/codemirror/mode/css/css.js" />
<script src="assets://com_wysiwyg/codemirror/mode/htmlmixed/htmlmixed.js" />
<script src="assets://com_wysiwyg/codemirror/mode/javascript/javascript.js" />
<script src="assets://com_wysiwyg/codemirror/mode/php/php.js" />
<script src="assets://com_wysiwyg/codemirror/mode/xml/xml.js" />

<style src="assets://com_wysiwyg/codemirror/lib/codemirror.css" />

<script>	
var quicktagsL10n = 
{
	quickLinks: "(Quick Links)",
	wordLookup: "Enter a word to look up:",
	dictionaryLookup: "Dictionary lookup",
	lookup: "lookup",
	closeAllOpenTags: "Close all open tags",
	closeTags: "close tags",
	enterURL: "Enter the URL",
	enterImageURL: "Enter the URL of the image",
	enterImageDescription: "Enter a description of the image"
};

try { convertEntities(quicktagsL10n);} catch(e) { };
</script>
<? endif ?>
		
<script>
Editor.baseurl = <?= json_encode(JURI::root()); ?>;

var TrafficInfo = {};
TrafficInfo.editor = new Editor(<?= json_encode($id) ?>, <?= json_encode($options) ?>, <?= json_encode($settings) ?>);
</script>
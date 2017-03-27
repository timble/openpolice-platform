<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? foreach($comments as $comment) :?>
<div class="comment">
    <div class="comment-header">
        <?= $comment->created_by == object('user')->id ? translate('You') : $comment->created_by_name ?>&nbsp;<?= translate('wrote') ?>
        <time datetime="<?= $comment->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $comment->created_on)) ?></time>
    </div>
    <p><?= escape($comment->text) ?></p>
</div>
<? endforeach ?>
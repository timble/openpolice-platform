<?= overlay(array('url' => route('option=com_activities&view=activities&layout=list'))); ?>

<div class="sidebar">
    <h3><?= translate('Announcements'); ?></h3>

    <table class="table">
        <? foreach(object('com:announcements.model.announcements')->getRowset() as $post) : ?>
            <tr>
                <td>
                    <a target="_blank" href="<?= $post->url ?>">
                        <?= $post->title ?>
                    </a>
                </td>
                <td>
                    <?= helper('date.humanize', array('date' => $post->date)) ?>
                </td>
            </tr>
        <? endforeach ?>
    </table>
</div>
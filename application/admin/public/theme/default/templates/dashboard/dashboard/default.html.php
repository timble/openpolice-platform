<?= overlay(array('url' => route('option=com_activities&view=activities&layout=list'))); ?>

<div class="sidebar">
    <h3><?= translate('Announcements'); ?></h3>

    <?
    $contents = file_get_contents('http://belgianpolice.github.io/blog.json');
    $contents = utf8_encode($contents);
    $posts = json_decode($contents);
    ?>

    <table class="table">
        <? foreach($posts as $post) : ?>
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
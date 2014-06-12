
<table class="table">
    <? foreach($announcements as $announcement): ?>
        <tr>
            <td>
                <a target="_blank" href="<?= $announcement->url ?>">
                    <?= $announcement->title ?>
                </a>
            </td>
            <td>
                <?= helper('date.humanize', array('date' => $announcement->date)) ?>
            </td>
        </tr>
    <? endforeach ?>
</table>
<table class="table">
    <? foreach($announcements as $announcement) : ?>
    <tr>
        <td>
            <a href="<?= route( 'view=announcement&id='.$announcement->id ); ?>">
                <?= escape($announcement->title) ?>
            </a>
        </td>
        <td>
            <?= helper('date.humanize', array('date' => $announcement->created_on)) ?>
        </td>
    </tr>
    <? endforeach ?>
</table>
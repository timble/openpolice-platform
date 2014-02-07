<? if(!$voted) : ?>

    <script src="assets://support/js/vote.js" />

    <script>
        window.addEvent('domready', function(){
            new Support.Vote({
                url: '<?= @route('view=vote') ?>',
                data: {
                    support_ticket_id: '<?= $ticket->id ?>',
                    users_user_id: '<?= object('user')->getId() ?>',
                    _token: '<?= object('user')->getSession()->getToken() ?>',
                    site: '<?=object('application')->getSite();?>'
                }
            });
        });
    </script>

    <div class="error"></div>

    <div style="display: none">
        <?= translate('Your vote has been registered, thanks!') ?> (<a href="" class="undo"><?= translate('undo') ?></a>)
    </div>
<? endif ?>

<div>
    <?
    if($ticket->votes == 0) {
        echo 'Nobody voted yet.';
    } else {
        $votes = $ticket->votes;

        if($voted) {
            echo 'You'.' '.(-- $votes ? 'and'.' ' : '');
        }

        if($votes) {

            echo $votes.' '.( $votes > 1 ? 'people' : 'person').' ';
        }

        switch($forum->type) {
            case 'article':
                echo 'found this helpful.';
                break;

            case 'idea':
                echo 'like this.';
                break;

            case 'question':
                echo 'would like this answered.';
                break;
        }
    }
    ?>

    <? if(!$voted) : ?>
        <a class="vote btn"><?= $ticket->votes ? translate('Me too!') : translate('Vote now!') ?><i class="icon-thumbs-up"></i></a>
    <? endif ?>
</div>
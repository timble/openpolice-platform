<? if(!$voted) : ?>

    <script src="assets://fora/js/vote.js" />

    <script>
        window.addEvent('domready', function(){
            new Fora.Vote({
                url: '<?= @route('view=vote') ?>',
                data: {
                    fora_topic_id: '<?= $topic->id ?>',
                    user_id: '<?= object('user')->getId() ?>',
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
    /* TODO: Make this translatable. Note: Translation not only means adding @text() to strings.
       Due the language differences, sentence can't be built from parts. The whole sentence should be used as translation key. */

//    if($topic->votes == 0) {
//        echo 'Nobody voted yet.';
//    } else {
//        $votes = $topic->votes;
//
//        if($voted) {
//            echo 'You'.' '.(--$votes ? 'and'.' ' : '');
//        }
//
//        if($votes) {
//            echo $votes.' '.($votes > 1 ? 'people' : 'person').' ';
//        }
//
//        switch($forum->type) {
//            case 'article':
//                echo 'found this helpful.';
//                break;
//
//            case 'idea':
//                echo 'like this.';
//                break;
//
//            case 'question':
//                echo 'would like this answered.';
//                break;
//        }
//    }
    ?>

    <? if(!$voted) : ?>
        <a class="vote btn btn-small"><?= $topic->votes ? translate('Me too!') : translate('Vote now!') ?></a>
    <? endif ?>
</div>
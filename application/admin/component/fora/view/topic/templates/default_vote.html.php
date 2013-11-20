<? if(!$voted) : ?>
    <?= @helper('behavior.mootools') ?>

    <script src="media://lib_koowa/js/koowa.js" />
    <script src="media://com_fora/js/vote.js" />

    <script>
        window.addEvent('domready', function(){
            new Fora.Vote({
                url: '<?= @route('view=vote') ?>',
                data: {
                    fora_topic_id: '<?= $topic->id ?>',
                    _token: '<?= JUtility::getToken() ?>'
                }
            });
        });
    </script>

    <div class="error"></div>

    <div style="display: none">
        <?= @text('Your vote has been registered, thanks!') ?> (<a href="" class="undo"><?= @text('undo') ?></a>)
    </div>
<? endif ?>

<div>
    <?
    /* TODO: Make this translatable. Note: Translation not only means adding @text() to strings.
       Due the language differences, sentence can't be built from parts. The whole sentence should be used as translation key. */

    if($topic->votes == 0) {
        echo 'Nobody voted yet.';
    } else {
        $votes = $topic->votes;

        if($voted) {
            echo 'You'.' '.(--$votes ? 'and'.' ' : '');
        }

        if($votes) {
            echo $votes.' '.($votes > 1 ? 'people' : 'person').' ';
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
        <a class="vote btn btn-small"><?= $topic->votes ? @text('Me too!') : @text('Vote now!') ?></a>
    <? endif ?>
</div>
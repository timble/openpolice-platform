<? $site = object('application')->getCfg('site') ?>

<? foreach($articles as $article) : ?>
    <? $link = '/'.$site.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <section class="news">
        <div class="news__image">
            <a class="news__image__content" href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '400', 'height' => '300'))) ?>
            </a>
        </div>
        <div class="news__content">
            <h2><a href="<?= $link ?>"><?= $article->title ?></a></h2>
            <?= $article->introtext ?>
        </div>
    </section>
<? endforeach ?>
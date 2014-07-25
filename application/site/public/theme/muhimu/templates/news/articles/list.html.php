<? $site = object('application')->getCfg('site') ?>

<? foreach($articles as $article) : ?>
    <? $link = '/'.$site.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <section class="news_grid">
        <div class="news_grid__image">
            <a class="news_grid__image__content" data-content="Lees meer" href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '400', 'height' => '300'))) ?>
            </a>
        </div>
        <div class="news_grid__content">
            <h2><a href="<?= $link ?>"><?= $article->title ?></a></h2>
            <?= $article->introtext ?>
        </div>
    </section>
<? endforeach ?>
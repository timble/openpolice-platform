<? $site = object('application')->getCfg('site') ?>

<? foreach($articles as $article) : ?>
    <? $link = '/'.$site.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <section class="media media--small">
        <div class="media__image">
            <a class="media__image__inner" data-content="Lees meer" href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '560', 'height' => '420'))) ?>
            </a>
        </div>
        <div class="media__content">
            <h1 class="media__title"><a href="<?= $link ?>"><?= $article->title ?></a></h1>
        </div>
    </section>
<? endforeach ?>
<? foreach($articles as $article) : ?>
    <? $link = '/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <section class="media">
        <div class="media__image">
            <a class="media__image__inner" data-content="<?= translate('Read more') ?>" href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '560', 'height' => '420'))) ?>
            </a>
        </div>
        <div class="media__content">
            <span class="text--muted text--small">
                <?= helper('date.format', array('date'=> $article->published_on, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'published'))) ?>
            </span>
            <h1 class="media__title"><a href="<?= $link ?>"><?= $article->title ?></a></h1>
        </div>
    </section>
<? endforeach ?>

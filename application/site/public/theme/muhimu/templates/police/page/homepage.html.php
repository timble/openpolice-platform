<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$site = object('application')->getCfg('site');

$pages = object('com:pages.model.pages')->menu('1')->sort('title')->direction('ASC')->published('true')->getRowset();
$pages = $pages->find(array('level' => '1', 'hidden' => false));

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
?>

<style type="text/css">
    .breadcrumb {
        display: none;
    }
</style>

<ktml:module position="breadcrumbs">
    <div class="container__header">
        <div class="quick_links">
            <p class="phone_numbers"><span>Call <strong>112</strong></span> in an emergency. Non-emergency? <span>Call <strong>000 000 000</strong></span>.</p>
            <ul>
                <li><a href="<?= $path ?>/declaration-or-report">Report a crime or disorder</a></li>
                <li><a href="<?= $path ?>/contact/your-neighbourhood">Find your neighbourhood</a></li>
                <li><a href="<?= $path ?>/licences-and-permits">Apply for a license or permit</a></li>
            </ul>
        </div>
        <div class="my_police">
            <h2 class="my_police__header">Search</h2>
            <input type="text" name="search" placeholder="Search this website ..." />
        </div>
    </div>
</ktml:module>

<div class="container__navigation">
<? foreach($pages as $page) : ?>
    <section class="navigation__item">
        <h2><a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a></h2>
        <p><?= $page->getParams('page')->get('page_description') ?></p>
    </section>
<? endforeach ?>
</div>

<hr class="divide" />

<div class="container__news">
    <? $stickies = object('com:news.model.articles')->sticky(true)->getRowset();
    $article = $stickies->count() ? $stickies->top() : object('com:news.model.articles')->limit('1')->sort('ordering_date')->direction('DESC')->published(true)->getRowset()->top(); ?>
    <? $link = $path.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <div class="news__featured">
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
                <p>
                    <?= $article->description ?>
                </p>
            </div>
        </section>
    </div>
    <div class="news__other">
        <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->exclude($article->id)->getRowset())) ?>
    </div>
</div>

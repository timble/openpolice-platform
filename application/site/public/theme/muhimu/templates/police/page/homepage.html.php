<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?
$pages = object('com:pages.model.pages')->menu('1')->sort('title')->direction('ASC')->published('true')->getRowset();
$pages = $pages->find(array('level' => '1', 'hidden' => false));
?>

<style type="text/css">
    .breadcrumb {
        display: none;
    }
</style>

<ktml:module position="breadcrumbs">
    <div class="container__header">
        <p class="phone_numbers"><span>Call <strong>112</strong></span> in an emergency. Non-emergency? <span>Call <strong>000 000 000</strong></span>.</p>
        <ul>
            <li><a href="/declaration-or-report">Report a crime or disturbance</a></li>
            <li><a href="/contact/your-neighbourhood">Find your neighbourhood</a></li>
            <li><a href="/licences-and-permits">Apply for a license or permit</a></li>
        </ul>
    </div>
</ktml:module>

<div class="container__navigation">
<? foreach($pages as $page) : ?>
    <section class="navigation__item">
        <h2><a href="/<?= $page->slug ?>"><?= $page->title ?></a></h2>
        <p><?= $page->getParams('page')->get('page_description') ?></p>
    </section>
<? endforeach ?>
</div>

<hr class="divide" />

<div class="container__news">
    <? $stickies = object('com:news.model.articles')->sticky(true)->getRowset();
    $article = $stickies->count() ? $stickies->top() : object('com:news.model.articles')->limit('1')->sort('ordering_date')->direction('DESC')->published(true)->getRowset()->top(); ?>
    <? $link = '/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <div class="news__featured">
        <section class="media">
            <div class="media__image">
                <a class="media__image__inner" data-content="<?= translate('Read more') ?>" href="<?= $link ?>">
                    <? if($article->attachments_attachment_id) : ?>
                    <?= helper('com:police.image.picture', array(
                            'attachment' => $article->attachments_attachment_id,
                            'srcset' => array(200, 240, 400),
                            'sizes' => array('1024px' => '240px', '600px' => '30vw'),
                            'ratio' => '4/3',
                            'attribs' => array())) ?>
                    <? endif ?>
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

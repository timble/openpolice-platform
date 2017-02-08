<?
$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$page       = $this->getObject('application.pages')->getActive();

$site = object('application')->getCfg('site');

$pages = $page->getDescendants();
$pages = $pages->find(array('level' => '2', 'hidden' => false));

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
$path .= '/'.$page->slug;
?>

<div class="container__navigation">
<? foreach($pages as $page) : ?>
    <section class="navigation__item">
        <h2><a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a></h2>
        <p><?= $page->getParams('page')->get('page_description') ?></p>
    </section>
<? endforeach ?>
</div>

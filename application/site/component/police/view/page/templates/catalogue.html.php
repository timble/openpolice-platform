<?
$page = $this->getObject('application.pages')->getActive();

$pages = $page->getDescendants();
$pages = $pages->find(array('level' => '2', 'hidden' => false));

$path = '/'.$page->slug;
?>

<div class="container__navigation">
<? foreach($pages as $page) : ?>
    <section class="navigation__item">
        <h2><a href="<?= $path ?>/<?= $page->slug ?>"><?= $page->title ?></a></h2>
        <p><?= $page->getParams('page')->get('page_description') ?></p>
    </section>
<? endforeach ?>
</div>

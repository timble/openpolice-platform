<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

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

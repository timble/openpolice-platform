<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<title content="replace"><?= $intro[$language]['title'] ?></title>
<meta content="<?= $intro[$language]['description'] ?>." name="description" />

<div class="intro__header">
    <div class="intro__container">
        <img src="assets://application/images/logo-<?= $language ?>.png" />
    </div>
</div>

<div class="intro">
    <div class="intro__search">
        <div class="intro__container">
            <div class="intro__search--inner">
                <form action="#" method="get">
                    <label class="search__label" for="search"><?= $search[$language]['label'] ?>:</label>
                    <div class="search-box">
                        <div class="search-box__input">
                            <input autofocus type="text" value="<?= $state->search ? $state->search : '' ?>" name="search" onfocus="this.value = this.value;" placeholder="<?= $search[$language]['placeholder'] ?>">
                        </div>
                        <button class="button button--primary search-box__button"><?= $button[$language] ?></button>
                    </div>
                </form>

                <? if($state->search) : ?>
                    <div class="municipalities">
                        <ul class="nav nav--pills column--double">
                            <? foreach ($municipalities as $municipality) : ?>
                                <li><a href="?municipality=<?= $municipality->streets_municipality_id.'&language='.$municipality->language ?>"><?= $municipality->title ?></a></li>
                            <? endforeach ?>
                        </ul>
                        <? if(!count($municipalities)) : ?>
                            <?= sprintf($notfound[$language], '<strong>'.$state->search.'</strong>') ?>
                        <? endif ?>
                        <?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>
                    </div>
                <? endif ?>
            </div>
        </div>
    </div>

    <div class="intro__external">
        <div class="intro__container">
            <? foreach ($external[$language] as $key => $value) : ?>
                <div class="external__item">
                    <h3><a href="<?= $external[$language][$key]['url'] ?>"><?= $external[$language][$key]['name'] ?></a></h3>
                    <p><?= $external[$language][$key]['description'] ?></p>
                </div>
            <? endforeach ?>
        </div>
    </div>

    <? //import('intro_news.html') ?>
    <?= import('intro_wanted.html') ?>

    <div class="intro__languages">
        <div class="intro__container">
            <ul class="nav nav--pills nav--horizontal">
                <li><a href="http://<?= $domain ?>.politie.be/intro">Nederlands</a></li>
                <li><a href="http://<?= $domain ?>.police.be/intro">Français</a></li>
                <li><a href="http://<?= $domain ?>.polizei.be/intro">Deutsch</a></li>
            </ul>
        </div>
    </div>

    <div class="intro__footer">

    </div>
</div>
<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<title content="replace"><?= $localpolice[$language] ?></title>
<meta content="<?= $search[$language] ?>." name="description" />

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
                        <ul class="nav nav--pills nav--visited column--double">
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

    <div class="intro__news">
        <div class="intro__container">
            <? foreach ($newsitems as $item) : ?>
                <? $article = $item->data; ?>
                <div class="intro__news__item card">
                    <a href="<?= $streams[$language]['news'].'/'.$article->id.'-'.$article->slug ?>">
                        <? if($article->thumbnail): ?>
                            <img width="400px" height="300px" src="<?= 'http://'.object('request')->getUrl()->getHost().'/files/fed/attachments/'.str_replace('.', '_thumb.', $article->thumbnail) ?>" />
                        <? endif ?>
                        <span class="card__metadata"><?= $article->title ?></span>
                    </a>
                </div>
            <? endforeach ?>
        </div>
    </div>

    <meta content="noimageindex" name="robots" />

    <div id="wanted" class="intro__wanted container">
        <div class="intro__container">
            <? $columns = array('missing' => array('section' => '1', 'name' => 'missing'), 'wanted' => array('section' => '2', 'name' => 'wanted')) ?>
            <? foreach ($sections as $section => $config): ?>
                <div class="intro__wanted--<?= $config['name'] ?>">
                    <h2><?= $wanted[$language][$config['name']]['name'] ?></h2>
                    <ul class="cards clearfix">
                        <? foreach ($wanteditems[$section] as $data) : ?>
                            <? $article = $data->data; ?>
                            <li class="card card--horizontal">
                                <a href="<?= $streams[$language]['wanted'].'/'.$article->section_slug.'/'.$article->category_slug ?>">
                                    <? if($article->thumbnail): ?>
                                        <img height="500px" width="400px" src="<?= 'http://'.object('request')->getUrl()->getHost().'/files/fed/attachments/'.str_replace('.', '_thumb.', $article->thumbnail) ?>" />
                                    <? else : ?>
                                        <img src="assets://found/images/placeholder.jpg" />
                                    <? endif ?>

                                    <span class="card__metadata">
                                    <span class="card__metadata--inner">
                                        <span class="card__name"><?= escape($article->title) ?></span>
                                        <span class="card__date"><?= date(array('date' => $article->date, 'format' => 'd/m/Y')) ?>
                                            <? $params = json_decode($article->params); ?>
                                            <? if(isset($params->place) || $article->city) : ?>
                                                <span class="card__place"><?= $article->city ? $article->city : $params->place ?></span>
                                            <? endif ?>
                                    </span>
                                </span>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <p><?= $wanted[$language][$config['name']]['description'] ?></p>
                    <a href="<?= $wanted[$language][$config['name']]['url'] ?>"><?= $wanted[$language][$config['name']]['link'] ?> &rarr;</a>
                </div>
            <? endforeach ?>
        </div>
    </div>

    <div class="intro__languages">
        <div class="intro__container">
            <ul class="nav nav--pills nav--visited nav--horizontal">
                <li><a href="http://<?= $domain ?>.lokalepolitie.be">Nederlands</a></li>
                <li><a href="http://<?= $domain ?>.policelocale.be">Français</a></li>
                <li><a href="http://<?= $domain ?>.lokalepolizei.be">Deutsch</a></li>
            </ul>
        </div>
    </div>

    <div class="intro__footer">

    </div>
</div>
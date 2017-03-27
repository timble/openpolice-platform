<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<div class="intro__news">
    <div class="intro__container">
        <? foreach ($newsitems as $item) : ?>
            <? $article = $item->data; ?>
            <div class="intro__news__item card">
                <a class="card__box" href="<?= $streams[$language]['news'].'/'.$article->id.'-'.$article->slug ?>">
                    <div class="card__image">
                        <? if($article->thumbnail): ?>
                            <img width="400px" height="300px" src="<?= 'http://'.object('request')->getUrl()->getHost().'/files/fed/attachments/'.str_replace('.', '_thumb.', $article->thumbnail) ?>" />
                        <? else : ?>
                            <img src="assets://news/images/placeholder.png" />
                        <? endif ?>
                    </div>
                    <div class="card__metadata">
                        <span class="card__name"><?= $article->title ?></span>
                    </div>
                </a>
            </div>
        <? endforeach ?>
    </div>
</div>

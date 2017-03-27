<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<meta content="noimageindex" name="robots" />

<ul class="cards clearfix">
    <? foreach ($articles as $article) : ?>
        <li class="card card--horizontal">
            <? if($article->solved): ?>
                <div class="card__box">
                    <div class="card__image card__image--wanted">
                        <img src="assets://wanted/images/solved.png" />
                    </div>

                    <span class="card__metadata">
                        <span class="card__metadata--inner">
                            <span class="card__name"><?= escape($article->title) ?></span>
                            <?= translate('The search warrant has been resolved') ?>.
                        </span>
                    </span>
                </div>
            <? else : ?>
                <a class="card__box" href="<?= helper('route.article', array('row' => $article)) ?>">
                    <div class="card__image card__image--wanted">
                        <? if($article->attachments_attachment_id) : ?>
                            <?= helper('com:police.image.thumbnail', array(
                                'attachment' => $article->attachments_attachment_id,
                                'attribs' => array('width' => '400', 'height' => '500'))) ?>
                        <? else : ?>
                            <img src="assets://wanted/images/solved.png" />
                        <? endif ?>
                    </div>

                    <div class="card__metadata">
                        <span class="card__name"><?= escape($article->title) ?></span>
                        <span class="card__date"><?= date(array('date' => $article->date, 'format' => translate('DATE_FORMAT_LC4'))) ?>
                        <? if($article->params->get('place', false) || $article->city) : ?>
                            <span class="card__place"><?= $article->city ? $article->city : $article->params->get('place') ?></span>
                        <? endif ?>
                        </span>
                    </div>
                </a>
            <? endif ?>
        </li>
    <? endforeach; ?>
</ul>

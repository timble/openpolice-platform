<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

    <title content="replace"><?= translate('Fora');?></title>

    <div class="page-header">
        <h1>Fora</h1>
    </div>
<div class="container">
    <div class="row">
        <form action="<?= route('view=topics&layout=search'); ?>" method="get" class="form-search well">
            <input type="hidden" name="forum" value="<?= $state->forum; ?>"/>
            <div class="input-append">
                <input id="searchword" name="searchword" class="input-xxlarge search-query" type="text"
                       value="<?= escape($state->searchword) ?>" placeholder="<?= translate('Search all forums') ?>"/>
                <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i></button>
            </div>
        </form>
    </div>

    <? foreach($categories as $category): ?>
        <div class="row">
            <div class="span12">
                <h2><?= $category->title ?></h2>
                <div class="row">
                    <? foreach(object('com:fora.model.forums')->category($category->id)->getRowset() as $forum): ?>
                        <div class="span4" >
                            <a href="<?= route('view=topics&layout=view&slug='.$forum->getSlug()) ?>">
                                <?= escape($forum->title);?>
                            </a><br />
                            <?= object('com:fora.model.topics')->forum($forum->id)->getTotal(); ?> <?= translate('Articles'); ?>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
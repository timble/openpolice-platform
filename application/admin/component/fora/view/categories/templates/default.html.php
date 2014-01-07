<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<?if($this->getObject('user')->getRole() == 25):?>
    <ktml:module position="actionbar">
        <ktml:toolbar type="actionbar">
    </ktml:module>
<?endif;?>
<style src="assets://fora/css/default.css" />

<div id="com_fora" class="scrollable">
    <div id="fora-categories-default">
        <div class="fora-search">
            <form action="<?= route('view=topics&layout=search') ?>" method="get" name="search">
                <input name="search" type="text" placeholder="<?= translate('Search all categories...') ?>" />
                <input class="btn primary" type="submit" value="Search" disabled="disabled" />
            </form>
        </div>

        <? foreach($categories as $category) : ?>
            <div class="well well-small">
                <div class="well__frame">
                    <h1 class="well__heading well__heading--left">
                        <a href="<?= route('view=category&id='.$category->id.'&slug='.$category->slug) ?>">
                            <?= escape($category->title) ?>
                        </a>
                    </h1>
                </div>
                <div class="well__content well__content--categories">
                    <?= import('default_items.html',
                        array('category' => $category, 'forums' => $forums, 'topics' => $topics, 'topics_count' => $topics_count)); ?>
                </div>
            </div>
        <? endforeach ?>
    </div>
</div>
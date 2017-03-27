<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<div class="well">
    <form class="search-box" action="<?=route('option=com_questions&view=questions&layout=search&Itemid=108')?>" method="get">
        <div class="search-box__input">
            <input name="searchword" type="search" value="<?=escape($state->searchword)?>" placeholder="<?=translate('Search')?> ..." tabindex="1"/>
        </div>
        <button type="submit" class="button button--primary search-box__button" tabindex="2"><?= translate('Search') ?></button>
    </form>
</div>
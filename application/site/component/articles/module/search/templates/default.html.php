<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if ($item_id): ?>
<form action="<?=route('option=com_articles&view=articles&Itemid=' . $item_id)?>" method="get" class="<?=$form_class?>">
    <div class="input-append">
        <input id="searchword" name="searchword" class="<?=$input_class?>" type="text" value=""
               placeholder="<?=translate($placeholder)?>"/>
        <button type="submit" class="<?=$button_class?>"><i class="icon-search"></i></button>
    </div>
</form>
<? endif; ?>
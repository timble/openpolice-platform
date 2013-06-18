<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="well">
    <form action="<?=@route('option=com_questions&view=articles')?>" method="get" class="form-search" style="margin-bottom: 0;">
        <div class="input-append">
            <input id="searchword" name="searchword" class="span7 search-query" type="text"
                   value="<?=@escape($state->searchword)?>" placeholder="<?=@text('Search')?> ..."/>
            <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i></button>
        </div>
    </form>
</div>
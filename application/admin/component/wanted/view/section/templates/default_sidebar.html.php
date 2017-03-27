<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

    <fieldset>
        <div>
            <label for="published"><?= translate('Published') ?></label>
            <div>
                <input type="checkbox" name="published" value="1" <?= $section->published ? 'checked="checked"' : '' ?> />
            </div>
        </div>
    </fieldset>

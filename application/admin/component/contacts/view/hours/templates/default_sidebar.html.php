<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Contacts') ?></h3>

<ul class="navigation">
    <? foreach ($categories as $category) : ?>
    <h4><?= $category->title ?></h4>
    <? foreach ($contacts->find(array('contacts_category_id' => $category->id)) as $contact) : ?>
        <li>
            <a class="<?= $state->contact == $contact->id ? 'active' : ''; ?>" href="<?= route('contact='.$contact->id ) ?>">
                <span class="navigation__text"><?= escape($contact->title) ?></span>
            </a>
        </li>
    <? endforeach ?>
    <? endforeach ?>
</ul>
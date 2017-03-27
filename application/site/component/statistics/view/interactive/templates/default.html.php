<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
 ?>

<title content="replace"><?= translate('Interactive crime statistics') ?></title>

<h1 class="article__header"><?= translate('Interactive crime statistics') ?></h1>

<div class="statistics__interactive">
    <?= import('default_pages.html') ?>
</div>

<? if($graph) : ?>
    <iframe frameborder="0" width="100%" height="680" src="/files/fed/crime/<?= $graph ?>.html?lang=<?= $language->slug ?>"></iframe>
<? endif ?>

<?= import('com:statistics.view.cities.default_footer.html', array('language' => $language)) ?>

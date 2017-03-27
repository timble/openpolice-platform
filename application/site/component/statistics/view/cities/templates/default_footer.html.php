<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
 ?>

<ul class="nav nav--pills nav--horizontal">
    <li>
        <a class="" href="<?= 'files://'.'crime/notes/'.$language->slug.'/'.object('lib:filter.slug')->sanitize(translate('warning')).'.pdf' ?>">
            <?= translate('Warning') ?> (pdf, 1 MB)
        </a>
    </li>
</ul>

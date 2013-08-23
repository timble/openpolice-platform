<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $params = $officer->params ?>

<div class="page-header">
	<h2><?= $officer->title ?></h2>
</div>
<div class="clearfix">	
	<p><?= $officer->description ?></p>
	<div style="float: right;">
		<? if($params->show_avatar && $params->avatar) : ?>
		<img class="thumbnail" width="100px" src="<?= 'images/avatars/'.$params->avatar ?>"/>
		<? else : ?>
		<img class="thumbnail" width="100px" src="media://com_districts/images/placeholder.png"/>
		<? endif; ?>
	</div>
	<div style="float: left; margin-left: 20px;">
		<ul>
			<? if($officer->phone) : ?><li><strong><?= translate('Phone') ?>:</strong> <?= $officer->phone ?></li><? endif ?>
			<? if($officer->mobile) : ?><li><strong><?= translate('Mobile') ?>:</strong> <?= $officer->mobile ?></li><? endif ?>
			<? if($officer->email) : ?><li><strong><?= translate('Email') ?>:</strong> <a href="mailto:<?= $officer->email ?>"><?= $officer->email ?></a></li><? endif ?>
		</ul>
	</div>
</div>
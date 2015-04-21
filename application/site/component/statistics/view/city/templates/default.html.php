<title content="replace"><?= translate('Statistics') ?> <?= translate('from') ?> <?= escape($city->title) ?></title>

<h1><?= translate('Statistics') ?> <?= translate('from') ?> <?= escape($city->title) ?></h1>
<h2><?= translate('Crime') ?></h2>

<? $zone = object('com:police.model.zones')->id($city->police_zone_id)->getRow(); ?>

<h3><?= translate('Semester') ?> 1, 2014</h3>

<ul>
    <li>
        <a download="2014-1-<?= object('lib:filter.slug')->sanitize($city->title).'_'.$language->slug ?>" href="<?= 'files://'.'crime/2014-1/city/'.$city->id.'_'.$language->slug.'.pdf' ?>">
            <?= $city->title ?> (pdf, 1 MB)
        </a>
    </li>
    <li>
        <a download="2014-1-<?= object('lib:filter.slug')->sanitize($zone->title).'_'.$language->slug ?>" href="<?= 'files://'.'crime/2014-1/zone/'.$city->police_zone_id.'_'.$language->slug.'.pdf' ?>">
            <?= translate('Police zone') ?> <?= $zone->title ?> (pdf, 1 MB)
        </a>
    </li>
    <li>
        <a download="2014-1-<?= object('lib:filter.slug')->sanitize($city->province).'_'.$language->slug ?>" href="<?= 'files://'.'crime/2014-1/province/'.$city->streets_province_id.'_'.$language->slug.'.pdf' ?>">
            <?= $city->province ?> (pdf, 1,5 MB)
        </a>
    </li>
    <li>
        <a download="2014-1-<?= object('lib:filter.slug')->sanitize($city->region).'_'.$language->slug ?>" href="<?= 'files://'.'crime/2014-1/region/'.$city->streets_region_id.'_'.$language->slug.'.pdf' ?>">
            <?= $city->region ?> (pdf, 1,5 MB)
        </a>
    </li>
    <li>
        <a download="2014-1-<?= object('lib:filter.slug')->sanitize(translate('Belgium')).'_'.$language->slug ?>" href="<?= 'files://'.'crime/2014-1/national/'.$language->slug.'.pdf' ?>">
            <?= translate('Belgium') ?> (pdf, 1,7 MB)
        </a>
    </li>
</ul>

<h3><?= translate('Nomenclature') ?></h3>

<ul>
<? foreach($notes as $note) : ?>
    <li>
        <a href="<?= 'files://'.'crime/notes/'.$language->slug.'/'.object('lib:filter.slug')->sanitize(translate($note)).'.pdf' ?>">
            <?= translate($note) ?>
        </a>
    </li>
<? endforeach ?>
</ul>
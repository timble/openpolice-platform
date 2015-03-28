<h1 class="article__header"><?= translate('Crime statistics') ?></h1>

<div class="statistics__reports">
    <h2><?= translate('Reports') ?></h2>
    <div class="well">
        <form class="search-box" action="#" method="get">
            <div class="search-box__input">
                <input autofocus type="text" value="<?= $state->searchword ? $state->searchword : '' ?>" name="searchword" onfocus="this.value = this.value;" placeholder="<?= translate('Search your city') ?>">
            </div>
            <button type="submit" class="button button--primary search-box__button" tabindex="2"><?= translate('Search') ?></button>
        </form>
    </div>

    <? if($state->searchword) : ?>
        <ul class="nav nav--pills">
            <? foreach($cities as $city) : ?>
                <li>
                    <a href="<?= helper('route.city', array('row' => $city)) ?>">
                        <?= $city->title ?>
                    </a>
                </li>
            <? endforeach ?>
        </ul>

        <? if(!$total) : ?>
            <span class="text--strong"><?= $state->searchword ?></span> <?= translate('not found') ?>.
        <? endif ?>
        <?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
    <? endif ?>
</div>

<hr />

<h2><?= translate('Interactive') ?></h2>
<div class="statistics__interactive">
    <?= import('com:statistics.view.interactive.default_pages.html') ?>
</div>



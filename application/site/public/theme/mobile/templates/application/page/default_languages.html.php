<? if(count($languages) > '1') : ?>
<ul class="languages">
    <? foreach($languages as $language) : ?>
    <li class="languages__item">
        <? if($language->iso_code != $active->iso_code) : ?>
        <a href="/<?= $site ?>/<?= $language->slug ?>"><?= $language->slug ?></a>
        <? else : ?>
        <?= $language->slug ?>
        <? endif ?>
    </li>
    <? endforeach ?>
</ul>
<? endif ?>

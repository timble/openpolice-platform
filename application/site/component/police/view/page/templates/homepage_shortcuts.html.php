<? $site = object('application')->getCfg('site') ?>

<div<?= $class ? ' class="'.$class.' alpha"' : '' ?>>
    <h3>Vergunningen</h3>
    <p>Een parkeerplaats nodig voor de verhuiswagen? Of om een container te plaatsen?</p>
    <a href="/<?= $site ?>/vragen/23-vergunningen">Vergunning aanvragen &rarr;</a>
</div>
<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3>Aangifte</h3>
    <p>Ben je slachtoffer van een misdrijf? Aarzel dan niet om aangifte te doen.</p>
    <a href="/<?= $site ?>/vragen">Doe aangifte &rarr;</a>
</div>
<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3>Vakantietoezicht</h3>
    <p>Vakantie in binnen- of buitenland? Wij houden een oogje in het zeil.</p>
    <a href="/<?= $site ?>/verkeer">Toezicht aanvragen &rarr;</a>
</div>
<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3>Verloren voorwerpen</h3>
    <p>Iets verloren? Misschien hebben wij je verloren voorwerp gevonden.</p>
    <a href="/<?= $site ?>/vragen/9-verlies-of-diefstal/ik-ben-iets-kwijt-wat-nu">Verloren voorwerpen &rarr;</a>
</div>

<? $site = @object('application')->getCfg('site') ?>

<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3><i class="icon-file-alt"></i> Vergunningen</h3>
    <p>Een parkeerplaats nodig voor de verhuiswagen? Of om een container te plaatsen?</p>
    <p><a href="<?= $site ?>/vragen/vergunningen">Vergunning aanvragen &rarr;</a></p>
</div>
<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3><i class="icon-question"></i> Veelgestelde vragen</h3>
    <p>Heb je een vraag? Zoek een antwoord tussen veelgestelde vragen.</p>
    <p><a href="<?= $site ?>/vragen">Beantwoord je vraag &rarr;</a></p>
</div>
<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3><i class="icon-road"></i>Verkeersinformatie</h3>
    <p>Zoek je informatie over controles, maatregelen of wegenwerken?</p>
    <p><a href="<?= $site ?>/verkeer">Bekijk de verkeersinformatie &rarr;</a></p>
</div>
<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <h3><i class="icon-key"></i> Verloren voorwerpen</h3>
    <p>Iets verloren? Misschien hebben wij je verloren voorwerp gevonden.</p>
    <p><a href="<?= $site ?>/vragen/verlies-of-diefstal/93-ik-ben-iets-kwijt-wat-nu">Verloren voorwerpen &rarr;</a></p>
</div>

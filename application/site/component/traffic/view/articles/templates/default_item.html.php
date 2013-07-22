<h2>
    <?= @helper('date.timestamp', array('start_on'=> $article->start_on, 'end_on' => $article->end_on)) ?>
    <small><?= $article->title ?></small>
</h2>

<? if($article->text) : ?>
    <?= $article->text ?>
<? endif ?>

<? if($streets = $this->getObject('com:streets.model.relations')->row($article->id)->table('traffic')->getRowset()) : ?>
<? foreach ($streets as $street) : ?>
    <?= $street->street ?>,
<? endforeach; ?>
<? else : ?>
    <?= @text('Grondgebied van Politie').' '.@object('com:police.model.zone')->id(@object('application')->getCfg('site' ))->getRow()->title ?>
<? endif ?>
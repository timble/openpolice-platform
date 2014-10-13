<? if($zone->twitter) : ?>
    <meta content="summary" name="twitter:card" />
    <meta content="@<?= $zone->twitter ?>" name="twitter:site" />
<? endif ?>
    <meta content="<?= @translate('Police') ?> <?= $zone->title ?>" property="og:site_name" />
    <meta content="<?= url(); ?>" property="og:url" />
<? if(isset($article->title)) : ?>
    <meta content="<?= escape($article->title) ?>" property="og:title" />
<? endif ?>
<? if(isset($article->introtext) || isset($article->text) || isset($article->description)) : ?>
    <meta content="<?= trim(preg_replace('/\s+/', ' ', strip_tags(substr($article->introtext ? $article->introtext : $article->text ? $article->text : $article->description, 0, 350)))).'...' ?>" property="og:description" />
<? endif ?>
<? if(isset($article->thumbnail)) : ?>
    <meta content="http://<?= $url ?>attachments://<?= $article->thumbnail ?>" property="og:image" />
<? endif ?>
    <meta content="article" property="og:type" />
<? if(isset($article->published_on)) : ?>
    <meta content="<?= $article->published_on ?>" property="article:published_time" />
<? endif ?>
<? if($zone->facebook) : ?>
    <meta content="https://www.facebook.com/<?= $zone->facebook ?>" property="article:publisher" />
<? endif ?>
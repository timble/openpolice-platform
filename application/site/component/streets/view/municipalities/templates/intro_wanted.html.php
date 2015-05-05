<meta content="noimageindex" name="robots" />

<div id="wanted" class="intro__wanted container">
    <div class="intro__container">
        <? $columns = array('missing' => array('section' => '1', 'name' => 'missing'), 'wanted' => array('section' => '2', 'name' => 'wanted')) ?>
        <? foreach ($sections as $section => $config): ?>
            <div class="intro__wanted--<?= $config['name'] ?>">
                <h2><?= $wanted[$language][$config['name']]['name'] ?></h2>
                <ul class="cards clearfix">
                    <? foreach ($wanteditems[$section] as $data) : ?>
                        <? $article = $data->data; ?>
                        <li class="card card--horizontal">
                            <a class="card__box" href="<?= $streams[$language]['wanted'].'/'.$article->section_slug.'/'.$article->category_slug.'/'.$article->id.'-'.$article->slug ?>">
                                <div class="card__image card__image--wanted">
                                    <? if($article->thumbnail): ?>
                                        <img height="500px" width="400px" src="<?= 'http://'.object('request')->getUrl()->getHost().'/files/fed/attachments/'.str_replace('.', '_thumb.', $article->thumbnail) ?>" />
                                    <? else : ?>
                                        <img src="assets://wanted/images/solved.png" />
                                    <? endif ?>
                                </div>

                                <div class="card__metadata">
                                    <span class="card__name"><?= escape($article->title) ?></span>
                                        <span class="card__date"><?= date(array('date' => $article->date, 'format' => translate('DATE_FORMAT_LC4'))) ?>
                                            <? $params = json_decode($article->params); ?>
                                            <? if(isset($params->place) || $article->city) : ?>
                                                <span class="card__place"><?= $article->city ? $article->city : $params->place ?></span>
                                            <? endif ?>
                                        </span>
                                </div>
                            </a>
                        </li>
                    <? endforeach; ?>
                </ul>
                <p><?= $wanted[$language][$config['name']]['description'] ?></p>
                <a href="<?= $wanted[$language][$config['name']]['url'] ?>"><?= $wanted[$language][$config['name']]['link'] ?> &rarr;</a>
            </div>
        <? endforeach ?>
    </div>
</div>
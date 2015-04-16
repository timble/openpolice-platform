<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <?= import('list.html') ?>

    <h3>Nieuwsbrief</h3>
    <form action="http://fedpol.fb.emailing.belgium.be/c253/h89ee4" method="post" name="">
        <p><input name="id" type="hidden" value="506"><span style="font-size:14px;">Schrijf u in om al de opsporingsberichten in uw mailbox te ontvangen.</span></p>

        <p><input name="email" type="text" value="" placeholder="naam@email.be"></p>

        <p><input class="button button--primary" name="action_subscribe" type="submit" value="Inschrijving"></p>

        <input name="type" type="hidden" value="0">
        <input name="ret" type="hidden" value="http://fedpol.fb.emailing.belgium.be/c250/h0d438">
        <input name="status" type="hidden" value="0">
    </form>
</ktml:module>

<? foreach($sections as $section) : ?>
    <div class="article">
        <h1 class="article__header">
            <a href="<?= helper('route.section', array('row' => $section)) ?>">
                <?= escape($section->title);?>
            </a>
        </h1>

        <?= import('com:wanted.view.articles.default_list.html', array('articles' => object('com:wanted.model.articles')->section($section->id)->limit('4')->published('1')->getRowset())) ?>

        <a class="article__readmore" href="<?= helper('route.section', array('row' => $section)) ?>"><?= translate('All section'.$section->id) ?></a>
    </div>
<? endforeach; ?>
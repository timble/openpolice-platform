<? if($youtube) : ?>
<?
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $youtube, $matches);
?>

<div class="article__video">
    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/<?= $matches[0] ?>" frameborder="0" allowfullscreen></iframe>
</div>
<? endif ?>
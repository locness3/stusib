<?php
if (!empty($static_page["cover_url"])) {
?>
<img class="post-cover" src="<?= $static_page["cover_url"] ?>" alt="">
<?php
}
?>
<h2 class="post-title"><?= $static_page["title"] ?></h2>
<?= $static_page["content_html"] ?>

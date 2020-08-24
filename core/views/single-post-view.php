<article class="post">
    <?php
    if (!empty($post["cover_url"])) {
    ?>
        <img class="post-cover" src="<?= $post["cover_url"] ?>" alt="">
    <?php
    }
    ?>
    <h2 class="post-title"><?= $post["title"] ?></h2>
    <div class="post-meta">
        <date class="post-date"><?= $post["date_created_fmt"] ?></date>
    </div>
    <?= $post["content_html"] ?>
</article>
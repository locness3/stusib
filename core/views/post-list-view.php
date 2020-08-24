<div class="post-list">

<?php
foreach ($posts as $post) {
?>
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
        <p class="post-excerpt">
        <?php
            if (!$post["summary"] == "") {
                echo $post["summary"];
            }
            else {
                echo strip_tags($post["content_html"], "<br><strong><em>");
            }
        ?>
        </p>
        <a class="post-read-more" href="./?post_id=<?= $post["id"] ?>">Read more &rarr;</a>
    </article>

<?php
}
?>

</div>

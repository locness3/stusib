<?php

function get_post($id)
{
    global $database;
    $parsedown = new Parsedown();
    $parsedown->setBreaksEnabled(true);

    $query = $database->prepare("SELECT *, 
    DATE_FORMAT(`date_created`, '%W, %M %D') AS date_created_fmt FROM posts WHERE id = ?");
    $query->execute(array($id));

    if ($query->rowCount() > 0) {
        $post = $query->fetch();
        $post = array_merge($post, [
            "content_html" => $parsedown->text($post["content"])
        ]);
        $query->closeCursor();
        return $post;
    }
    else {
        $query->closeCursor();
        return false;
    }
}

function get_posts()
{
    global $database;
    $parsedown = new Parsedown();
    $parsedown->setBreaksEnabled(true);

    $query = $database->query("SELECT id, title, cover_url, summary, content,
    DATE_FORMAT(`date_created`, '%W, %M %D') AS date_created_fmt FROM posts");

    if ($query->rowCount() > 0) {
        $posts = [];
        while ($post = $query->fetch()) {
            $posts[] = array_merge($post, [
                "content_html" => $parsedown->text($post["content"])
            ]);
        }

        $query->closeCursor();
        return $posts;
    } else {
        return false;
    }
}

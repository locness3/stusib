<?php

function get_static_page($id) {
    global $database;
    $parsedown = new Parsedown();
    $parsedown->setBreaksEnabled(true);

    $query = $database->prepare("SELECT * FROM static_pages WHERE id = ?");
    $query->execute(array($id));

    if ($query->rowCount() == 1) {
        $static_page = $query->fetch();
        $static_page = array_merge($static_page, [
            "content_html" => $parsedown->text($static_page["content"])
        ]);
        $query->closeCursor();
        return $static_page;
    }
    else {
        $query->closeCursor();
        return false;
    }
}
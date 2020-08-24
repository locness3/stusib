<?php
ob_start();

require BASEDIR . "/core/models/posts-model.php";
if (isset($_GET["post_id"]) && !empty($_GET["post_id"])) {
    if (!$post = get_post($_GET["post_id"])) {
        http_response_code(404);
        require BASEDIR . "/core/views/not-found-view.php";
    }
    else {
        require BASEDIR . "/core/views/single-post-view.php";
    }
}
else {
    http_response_code(404);
    require BASEDIR . "/core/views/not-found-view.php";
}

$content = ob_get_clean();
require TEMPLATEDIR . "/default.php";
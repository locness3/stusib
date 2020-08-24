<?php
ob_start();

require BASEDIR . "/core/models/posts-model.php";

$posts = get_posts();
require BASEDIR . "/core/views/post-list-view.php";

$content = ob_get_clean();
require TEMPLATEDIR . "/default.php";
<?php
ob_start();

require BASEDIR . "/plugins/static_pages/models/static-pages-model.php";

$default_page = get_option_value("static_pages/default_page");
if (isset($_GET["page_id"]) && !empty($_GET["page_id"])) {
    $static_page_id = $_GET["page_id"];
}
else {
    $static_page_id = get_option_value("static_pages/default_page");
}

if (!$static_page = get_static_page($static_page_id)) {
    require BASEDIR . "/core/views/not-found-view.php";
}
else {
    require BASEDIR . "/plugins/static_pages/views/static-page-view.php";
}

$content = ob_get_clean();
require TEMPLATEDIR . "/default.php";
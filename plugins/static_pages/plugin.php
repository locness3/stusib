<?php

require_once BASEDIR . "/options-model.php";

$routes["single-page"] = [
    "name" => "single-page",
    "trigger_params" => ["page_id", "page"],
    "controller" => BASEDIR . "/plugins/static_pages/controllers/static-page-controller.php"
];

if (get_option_value("static_pages/use_as_homepage") == 1) {
    $fallback_route = $routes["single-page"];
}
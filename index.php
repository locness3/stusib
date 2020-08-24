<?php
/* stusib - stupidly simple blog
   by locness3
   licensed under the GNU GPL 3.0
   https://github.com/locness3/stusib
*/

$start_time = microtime(true);

/*
Bootstrap
*/

// Enable error reporting.
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);

// Define the BASEDIR constant, which is the directory where stusib is installed.
// Used for requiring and including files.
define("BASEDIR", __DIR__);

// Autoload vendor classes.
require BASEDIR . "/vendor/autoload.php";

// Load helper functions.
require BASEDIR . "/functions.php";
// Load the base configuration, which contains the database credentials.
require BASEDIR . "/config.php";

// Connect to the database.
try {
    $database = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
} catch (Exception $e) {
    die("A wild bug appears!\n" . $e->getMessage());
}

// Load the options model.
require BASEDIR . "/options-model.php";

// Get the currently active template from the options, and set TEMPLATEDIR
// to its directory.
define("TEMPLATEDIR", BASEDIR . "/template/" . get_option_value("active_template", true));

// Create the array of routes.
$routes = [];

/*
Built-in routes
*/

$routes["single-post"] = [
    "name" => "single-post",
    "trigger_params" => ["post_id"],
    "controller" => BASEDIR . "/core/controllers/single-post-controller.php"
];

$routes["post-list"] = [
    "name" => "post-list",
    "controller" => BASEDIR . "/core/controllers/post-list-controller.php"
];

$fallback_route = $routes["post-list"];

/*
Active plugins loading
*/

$activeplugins = explode(",", get_option_value("active_plugins", true));
foreach ($activeplugins as $plugin) {
    require_once BASEDIR . "/plugins/" . $plugin . "/plugin.php";
}

/*
Routing
*/

// Crappy "routing" system. For each route :
foreach ($routes as $route_name => $route) {
    // If the query parameter "do" equals the route name,
    if (isset($_GET["do"]) && $_GET["do"] == $route["name"]) {
        // Load the route's controller and stop there.
        require_once $route["controller"];
        exit();
    }

    // Otherwise, if trigger params are defined for the route
    else if (isset($route["trigger_params"])) {
        // If one of the trigger is found in the query parameters
        foreach ($route["trigger_params"] as $param) {
            if (isset($_GET[$param])) {
                // Load the route's controller and stop there.
                require_once $route["controller"];
                exit();
            }
        }
    }
}

// No route matched, fall back to the fallback route.
require_once $fallback_route["controller"];
exit();

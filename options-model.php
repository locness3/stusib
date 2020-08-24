<?php

function get_option_value($name, $as_text = false) {
    global $database;

    $query = $database->prepare("SELECT value_int, value_text FROM options WHERE name = ?");
    $query->execute([$name]);
    $result = $query->fetch();

    if ($as_text == true) {
        return $result["value_text"];
    }
    else {
        return $result["value_int"];
    }
}
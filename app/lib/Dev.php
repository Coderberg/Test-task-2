<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($string)
{
    echo '<pre>';
    var_dump($string);
    echo '</pre>';
    exit;
}

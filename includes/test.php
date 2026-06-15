<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if (isset($_GET['manufacturerids'])) {

    $manufacturerids = $_GET['manufacturerids'];

    foreach ($manufacturerids as $m) {
        echo $m;
    }
}

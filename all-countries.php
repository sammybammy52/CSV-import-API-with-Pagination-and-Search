<?php

include_once 'headers.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\Countries;

$obj = new Countries();

$api = $_SERVER['REQUEST_METHOD'];

if ($api == 'GET') {
    if (isset($_GET['search']) && $_GET['search'] !== NULL && $_GET['search'] !== '') {
        $obj->searchCountries();
    } else {
        $obj->getCountries();
    }
    
}
<?php

include_once 'headers.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\Currencies;

$obj = new Currencies();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

if ($api == 'GET') {
    if (isset($_GET['search']) && $_GET['search'] !== NULL && $_GET['search'] !== '') {
        $obj->searchCurrencies();
    } else {
        $obj->getCurrencies();
    }
    
}
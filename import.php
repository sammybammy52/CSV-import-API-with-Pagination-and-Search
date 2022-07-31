<?php
include_once 'headers.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\DataImport;
//


// Create object of Users class
$user = new DataImport();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

$filters = [
    isset($_POST['db']),
    isset($_FILES['file']),
    $_FILES['file'],
    !$_FILES['file']['error'] > 0,
    $_FILES["file"]["size"] < 900000 //900kb
    

];

if ($api == 'POST' && in_array(false, $filters) == false) {
    if ($_POST['db'] === 'countries') {
        $user->import_countries();
    }
    elseif ($_POST['db'] === 'currencies') {
        $user->import_currencies();
    }
    else {
        $message = ['message' => 'invalid database selection'];
        echo json_encode($message);
    }
    
}
else{
    $message = ['message' => 'Please Check File or Database Selection'];
    echo json_encode($message);
}





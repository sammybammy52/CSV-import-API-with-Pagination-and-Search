<?php
namespace App\Controllers;
use Exception;

class Computations {
    public function computeNumPages($no_of_rows, $resultsPerPage)
    {
        if (!$no_of_rows || !$resultsPerPage) {
            throw new Exception('Could not count items for you');
        } else {
            
            $numPages = ceil($no_of_rows / $resultsPerPage);
            return $numPages;
        }
    }

    public function startingLimit($page_number, $resultsPerPage){

        $startingLimit = ($page_number - 1) * $resultsPerPage;

        return $startingLimit;
    }

    public function getPage($getPage){
        if (isset($getPage) && $getPage !== NULL && $getPage !== '') {
            $page_number = $getPage;
            return $page_number;
        }
        else{
            $page_number = 1;
            return $page_number;
        }
    }
}
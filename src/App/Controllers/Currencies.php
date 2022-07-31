<?php

namespace App\Controllers;
use App\Controllers\Config;
use App\Controllers\Computations;
use Exception;

class Currencies extends Config {

    public function numPages($search = NULL)
    {
        $sql = "SELECT COUNT(id) FROM `Currencies`";
        if ($search != NULL) {
            $sql = "SELECT COUNT(id) FROM `Currencies` WHERE CONCAT(iso_code, common_name) LIKE '%$search%'";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
        $no_of_rows = $rows[0]['COUNT(id)'];

        $obj = new Computations;

        $resultsPerPage = 15;

        $result = $obj->computeNumPages($no_of_rows, $resultsPerPage);

        if (!$result) {
            throw new Exception('Could not count items for currencies');
        } else {
            
            return $result;
        }

    }


    public function getCurrencies()
    {
        try {

            $obj = new Computations;
            
            $page_number = $obj->getPage($_GET['page']);
            
            $numPages = $this->numPages();
                
            $resultsPerPage = 15;
    
            $startingLimit = $obj->startingLimit($page_number, $resultsPerPage);
    
            $sql = "SELECT * FROM `Currencies` LIMIT " . $startingLimit . ',' . $resultsPerPage;
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            
            if (count($rows) > 0) {
    
    
                $response = [
                    'rows' => $rows,
                    'numPages' => $numPages
                ];
            }
            else {
                $response = [
                    'message' => 'no record found'
                ];
            }
            
    
            echo json_encode($response);
        } catch (Exception $e) {
            $message = [
                'error' => 'Oops something went wrong while getting your data',
                'details' => $e->getMessage()
            ];

            echo json_encode($message);
        }

        
    }
    public function searchCurrencies()
    {
        try {
           
            $obj = new Computations;

            $page_number = $obj->getPage($_GET['page']);

            $resultsPerPage = 15;

            $startingLimit = $obj->startingLimit($page_number, $resultsPerPage);
        
            $search = $_GET['search'];
    
            $numPages = $this->numPages($search);
    
            $sql = "SELECT * FROM `Currencies` WHERE CONCAT(iso_code, common_name) LIKE '%$search%' LIMIT ". $startingLimit . ',' . $resultsPerPage;
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            
            if (count($rows) > 0) {
    
                $response = [
                    'rows' => $rows,
                    'numPages' => $numPages
                ];
    
            }
            else {
                $response = [
                    'message' => 'no record found'
                ];
            }
    
            echo json_encode($response);
        } catch (Exception $e) {
            $message = [
                'error' => 'Sorry, Unable to get your data :(',
                'details' => $e->getMessage()
            ];

            echo json_encode($message);
        }
        
    }
}
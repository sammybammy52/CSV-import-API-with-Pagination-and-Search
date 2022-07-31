<?php
namespace App\Controllers;

use App\Controllers\Config;
use PhpOffice\PHPSpreadsheet\spreadsheet;
use PhpOffice\PHPSpreadsheet\Writer\xlsx;
use Exception;

//require './vendor/autoload.php';

class FirstRowFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        //  Return true for rows after first row
        return $row > 1;
    }
}


class DataImport extends Config
{

    public function import_countries()
    {

        $upload_file = $_FILES['file']['name'];
        $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
        $allowed_ext = 'csv';
        if ($file_ext == $allowed_ext) {
            try {
                
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                $filterRow = new FirstRowFilter();

                $reader->setReadFilter($filterRow);

                $inputFileNamepath = $_FILES['file']['tmp_name'];

                $spreadsheet = $reader->load($inputFileNamepath);

                $data = $spreadsheet->getActiveSheet()->toarray();
                foreach ($data as $row) {

                    $insert_data = array(
                        ':continent_code' => $row[0],
                        ':currency_code' => $row[1],
                        ':iso2_code' => $row[2],
                        ':iso3_code' => $row[3],
                        ':iso_numeric_code' => $row[4],
                        ':fips_code' => $row[5],
                        ':calling_code' => $row[6],
                        ':common_name' => $row[7],
                        ':official_name' => $row[8],
                        ':endonym' => $row[9],
                        ':demonym' => $row[10]

                    );

                    //Sql to insert into the database 
                    $sql = "INSERT into Countries (continent_code, currency_code, iso2_code, iso3_code, iso_numeric_code, fips_code, calling_code, common_name, official_name, endonym, demonym) values(:continent_code, :currency_code, :iso2_code, :iso3_code, :iso_numeric_code, :fips_code, :calling_code, :common_name, :official_name, :endonym, :demonym)";

                    $stmt = $this->conn->prepare($sql);

                    $stmt->execute($insert_data);
                }

                $message = ['message' => 'Operation Successful'];

                echo json_encode($message);
            } catch (Exception $e) {
                $message = [
                    'error' => 'Oops something went wrong while loading file',
                    'details' => $e->getMessage()
                ];

                echo json_encode($message);
            }
        }
    }

    public function import_currencies()
    {

        $upload_file = $_FILES['file']['name'];
        $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
        $allowed_ext = 'csv';
        if ($file_ext == $allowed_ext) {
            try {
//                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($upload_file);

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                $filterRow = new FirstRowFilter();

                $reader->setReadFilter($filterRow);

                $inputFileNamepath = $_FILES['file']['tmp_name'];

                $spreadsheet = $reader->load($inputFileNamepath);

                $data = $spreadsheet->getActiveSheet()->toarray();
                foreach ($data as $row) {

                    $insert_data = array(
                        ':iso_code' => $row[0],
                        ':iso_numeric_code' => $row[1],
                        ':common_name' => $row[2],
                        ':official_name' => $row[3],
                        ':symbol' => $row[4]

                    );

                    //Sql to insert into the database 
                    $sql = "INSERT into Currencies (iso_code, iso_numeric_code, common_name, official_name, symbol) values(:iso_code, :iso_numeric_code, :common_name, :official_name, :symbol)";

                    $stmt = $this->conn->prepare($sql);

                    $stmt->execute($insert_data);
                }

                $message = ['message' => 'Operation Successful'];

                echo json_encode($message);
            } catch (Exception $e) {
                $message = [
                    'error' => 'Oops something went wrong while loading file',
                    'details' => $e->getMessage()
                ];

                echo json_encode($message);
            }
        }
        else {
            $message = [
                'error' => 'unsupported file type'
            ];

            echo json_encode($message);
        }
    }
}

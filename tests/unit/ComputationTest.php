<?php


require_once './vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Controllers\Computations;

class ComputationTest extends TestCase
{

    public function testcomputeNumPages()
    {
        $obj = new Computations;

        $this->assertIsNumeric($obj->computeNumPages(226,15));
        $this->assertEquals(16, $obj->computeNumPages(238,15));
        $this->assertEquals(159, $obj->computeNumPages(2384,15));
        $this->assertEquals(16, $obj->computeNumPages(226,15));

        
    }

    public function testcomputeStartingLimit()
    {
        $obj = new Computations;

        $this->assertIsNumeric($obj->startingLimit(1,15));
        $this->assertEquals(0, $obj->startingLimit(1,15));
        $this->assertEquals(15, $obj->startingLimit(2,15));


    }

    public function testgetPage()
    {
        $obj = new Computations;

        $this->assertEquals(1, $obj->getPage(NULL));
        $this->assertEquals(10, $obj->getPage(10));
        $this->assertEquals(20, $obj->getPage(20));
    }
}

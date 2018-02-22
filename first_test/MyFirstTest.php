<?php
require __DIR__ . "/Area.php";

use PHPunit\Framework\TestCase;
// use Area;

class MyFirstTest extends TestCase
{
    public function testArray()
    {
        $array=[2   ];
        $this->assertNotEmpty($array);
    }

    public function testArea()
    {
        $area = new Area();
        $this->assertEquals(6, $area->getArea(2,3));
    }
}
<?php

//use PHPunit\Framework\TestCase;
use SON\Area;

class MyFirstTest extends PHPUnit\Framework\TestCase
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
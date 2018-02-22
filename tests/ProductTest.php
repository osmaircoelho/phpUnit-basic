<?php

class ProductTest extends PHPUnit\Framework\TestCase
{
    public function testSetName()
    {
        $product = new SON\Model\Product();
        $product->setName("My product 1");
        $this->assertEquals('My product 1', $product->getName());
    }

    public function testSetPrice()
    {
        $product = new SON\Model\Product();
        $product->setPrice(10.10);
        $this->assertEquals(10.10, $product->getPrice());

        $this->assertInstanceOf(\SON\Model\Product::class, $product );
    }
}
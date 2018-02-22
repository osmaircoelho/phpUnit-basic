<?php

class ProductTest extends PHPUnit\Framework\TestCase
{
    public function testIfIdIsNull()
    {
        global $db;
        echo get_class($db);

        $product = new SON\Model\Product();
        $this->assertNull($product->getId());
    }

    /*public function testSetAndGetName()
    {
        $product = new SON\Model\Product();
        $this->assertNull($product->getName());
        $this->assertInstanceOf(\SON\Model\Product::class, $product->setName('My product 1'));
        $this->assertEquals('My product 1', $product->getName());
    }

    public function testSetAndGetPrice()
    {
        $product = new SON\Model\Product();
        $this->assertNull($product->getPrice());
        $this->assertInstanceOf(\SON\Model\Product::class, $product->setPrice(10.11));
        $this->assertEquals(10.11, $product->getPrice());
    }

    public function testSetAndGetQuantity()
    {
        $product = new SON\Model\Product();
        $this->assertNull($product->getQuantity());
        $this->assertInstanceOf(\SON\Model\Product::class, $product->setQuantity(5));
        $this->assertEquals(5, $product->getQuantity());
    }*/

    public function testIfTotalIsNull()
    {
        $product = new SON\Model\Product();
        $this->assertNull($product->getTotal());
    }

    /**
     * @dataProvider collectionData
     */

    public function testEncapsulate($property, $expected)
    {
        $product = new SON\Model\Product();

        $null = $product->{'get'.ucfirst($property)}();
        $this->assertNull($null);

        $result = $product->{'set'.ucfirst($property)}($expected);
        $this->assertInstanceOf(\SON\Model\Product::class, $result);

        $actual = $product->{'get'.ucfirst($property)}();
        $this->assertEquals($expected, $actual);
    }

    public function collectionData()
    {
        return [
            ['name','Product 1'],
            ['price',10.11],
            ['quantity',5],
        ];
    }
}
<?php

class ProductDBTest extends PHPUnit\Framework\TestCase
{
    protected $backupGlobals = false;

    private $db;

    protected function setUp()
    {
        $this->db = getPDO();
    }

    public function testIfProductIsSaved()
    {
     /*   $result = $this->createProduct();
        $this->assertEquals(1, $result->getId());
        $this->assertEquals('Produto 1', $result->getName());
        $this->assertEquals(200.20, $result->getPrice());
        $this->assertEquals(10, $result->getQuantity());
        $this->assertEquals(200.20 * 10, $result->getTotal());
        return $result->getId();*/

     $db = $this->db;

     $product = new \SON\Model\Product($db);
     $result = $product->save([
         'name' => 'Product 1',
         'price' => 200.20,
         'quantity' => 10

     ]);
        $this->assertEquals(1, $result->getId());
        $this->assertEquals('Product 1',$result->getName());
        $this->assertEquals(200.20, $result->getPrice());
        $this->assertEquals(10, $result->getQuantity());
        $this->assertEquals(200.20 * 10, $result->getTotal());
    }

    public function testIfListProducts()
    {
        $db = $this->db;

        $product = new \SON\Model\Product($db);
         $product->save([
            'name' => 'Product 1',
            'price' => 200.20,
            'quantity' => 10
        ]);

        $products = $product->all();
        $this->assertCount(1, $products);
    }
}
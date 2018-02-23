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
        $result = $this->createProduct();

        $this->assertEquals(1, $result->getId());
        $this->assertEquals('Product 1',$result->getName());
        $this->assertEquals(200.20, $result->getPrice());
        $this->assertEquals(10, $result->getQuantity());
        $this->assertEquals(200.20 * 10, $result->getTotal());
        return $result->getId();
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

    /**
     *@depends testIfProductIsSaved
     *
     */
    public function testIfProductIsUpdated($id)
     {
        $db = $this->db;

        $product = new \SON\Model\Product($db);
        $result = $product->save([
            'id' => $id,
            'name' => 'Product updated',
            'price' => 300.20,
            'quantity' => 20

        ]);
        $this->assertEquals($id, $result->getId());
        $this->assertEquals('Product updated',$result->getName());
        $this->assertEquals(300.20, $result->getPrice());
        $this->assertEquals(20, $result->getQuantity());
        $this->assertEquals(300.20 * 20, $result->getTotal());
        return $id;
    }

    /**
     * @depends testIfProductIsUpdated
     *
     */
    public function testIfProductCanBeRecovered()
    {
        $this->createProduct();

        $db = $this->db;
        $product = new \SON\Model\Product($db);
        $result = $product->find(1);

        $this->assertEquals(1, $result->getId());
        $this->assertEquals('Product 1', $result->getName());
        $this->assertEquals(200.20, $result->getPrice());
        $this->assertEquals(10, $result->getQuantity());
        $this->assertEquals(200.20 * 10, $result->getTotal());
    }

    /**
     * @depends testIfProductIsUpdated
     */
    public function testIfProductCanDeleted($id)
    {
        $db = $this->db;
        $product = new \SON\Model\Product($db);
        $result = $product->delete($id);

        $this->assertTrue($result);
        $products = $product->all();
        $this->assertCount(0, $products);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Product not available
     */
    public function testIfProductNotFound()
    {
        $db = $this->db;
        $product = new \SON\Model\Product($db);
        $product->find(99999);
    }

    private function createProduct(){
        $db = $this->db;
        $product = new \SON\Model\Product($db);
        return $product->save([
            'name' => 'Product 1',
            'price' => 200.20,
            'quantity' => 10
        ]);
    }
}
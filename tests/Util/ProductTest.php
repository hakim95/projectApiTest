<?php

namespace App\Tests\Util;

use App\Util\Product;

class ProductTest extends \PHPUnit\Framework\TestCase 
{    
    public function testCalculateTtc()
    {
        $product = new Product();
        $priceTtc = $product->calculateTtc(289);
        
        $this->assertEquals(346.80, $priceTtc);
    }
    
    public function testNegativePrice()
    {
        $product = new Product();
                
        $this->expectException('Exception');
        
        $priceTtc = $product->calculateTtc(-10);
    }
    
    public function testZeroPrice()
    {
        $product = new Product();
        
        $this->expectException('Exception');
        
        $priceTtc = $product->calculateTtc(0);
    }
}

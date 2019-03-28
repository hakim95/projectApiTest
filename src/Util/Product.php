<?php

namespace App\Util;

class Product 
{
    const TVA = 1.2;
       
    public function calculateTtc($priceHt)
    {
        if ($priceHt <= 0) {
            throw new \Exception('Invalid price');
        }
        
        $priceTtc = $priceHt * self::TVA;
        
        return $priceTtc;
    }    
}

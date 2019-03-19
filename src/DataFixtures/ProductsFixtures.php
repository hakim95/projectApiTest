<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Products;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Products();
        $product->setDescription('Disque dur externe 2To Western Digital');
        $product->setPriceht(78);
        $product->setPricettc(94);
        $product->setImages('test');
        $product->setName('WD2C302DC');
        $manager->persist($product);
        
        $product2 = new Products();
        $product2->setDescription('Disque dur interne SSD 512Go Samsung');
        $product2->setPriceht(133);
        $product2->setPricettc(160);
        $product2->setImages('test');
        $product2->setName('SMG860PRO');
        $manager->persist($product2);
        
        $product3 = new Products();
        $product3->setDescription('PS4 pro 1To');
        $product3->setPriceht(263);
        $product3->setPricettc(315);
        $product3->setImages('test');
        $product3->setName('SPS41581');
        $manager->persist($product3);
        
        $product4 = new Products();
        $product4->setDescription('Imprimante 4 en 1 HP officejet');
        $product4->setPriceht(50);
        $product4->setPricettc(60);
        $product4->setImages('test');
        $product4->setName('HP5232001');
        $manager->persist($product4);

        $manager->flush();
    }
}

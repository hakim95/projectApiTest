<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Orders;

class OrdersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $order = new Orders();
        $order->setPriceht(341);
        $order->setPriceTtc(409);
        $order->setDate(new \DateTime('2019-02-28'));
        $manager->persist($order);
        
        $order2 = new Orders();
        $order2->setPriceht(50);
        $order2->setPriceTtc(60);
        $order2->setDate(new \Datetime('2019-03-11'));
        $manager->persist($order2);

        $manager->flush();
    }
}

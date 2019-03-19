<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Customers;

class CustomersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $customer = new Customers();
        $customer->setFirstname('Eric');
        $customer->setLastname('Dupont');
        $customer->setAddress('34 rue de la plaine');
        $customer->setPostcode('78800');
        $customer->setCity('Houilles');
        $customer->setCountry('France');
        $customer->setPhone('0606060606');
        $manager->persist($customer);

        $customer2 = new Customers();
        $customer2->setFirstname('Faycal');
        $customer2->setLastname('Mohammed');
        $customer2->setAddress('111 chemin des peupliers');
        $customer2->setPostcode('92230');
        $customer2->setCity('Gennevilliers');
        $customer2->setCountry('France');
        $customer2->setPhone('0605040302');
        $manager->persist($customer2);

        $manager->flush();
    }
}

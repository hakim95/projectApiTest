<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class CustomerController extends AbstractController
{
    /**
     * List of customers
     * 
     * @Route("/api/customers", name="customers", methods={"GET"})
     * @SWG\Response(
     *      response=200,
     *      description="Returns list of customers"
     * )
     * @SWG\Tag(name="customers")
     */
    public function customers()
    {
        $repo = $this->getDoctrine()->getRepository('\App\Entity\Customers');
        
        $customersResult = $repo->findAll();
        
        $customers = array();
        
        foreach ($customersResult as $customer) {
            array_push($customers, array(
                'firstname' => $customer->getFirstname(),
                'lastname' => $customer->getLastname(),
                'address' => $customer->getAddress(),
                'postcode' => $customer->getPostcode(),
                'city' => $customer->getCity(),
                'country' => $customer->getCountry(),
                'phone' => $customer->getPhone()
            ));
        }
        
        return $this->json($customers);
    }
    
    /**
     * Get customer details
     * 
     * @Route("/api/customers/{customerid}", name="customer", methods={"GET"})
     * @SWG\Response(
     *      response=200,
     *      description="Returns a customer"
     * )
     * @SWG\Tag(name="customers")
     */
    public function customer(Request $request)
    {
        $customerid = $request->attributes->get('customerid');
        
        $repo = $this->getDoctrine()->getRepository('\App\Entity\Customers');
        
        $customerResult = $repo->find($customerid);
        
        $customer = array(
            'firstname' => $customerResult->getFirstname(),
            'lastname' => $customerResult->getLastname(),
            'address' => $customerResult->getAddress(),
            'postcode' => $customerResult->getPostcode(),
            'city' => $customerResult->getCity(),
            'country' => $customerResult->getCountry(),
            'phone' => $customerResult->getPhone()
        );
        
        return $this->json($customer);
    }
}

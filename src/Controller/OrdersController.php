<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class OrdersController extends AbstractController
{
    /**
     * @Route("/invoice/{orderid}", name="invoice")
     */
    public function index(Request $request, Pdf $pdf)
    {
        $orderid = $request->attributes->get('orderid');
        
        try {
            $repo = $this->getDoctrine()->getRepository('App\Entity\Orders');

            $orderInfos = $repo->findOrdersInfosById($orderid);
            
            if (!$orderInfos) {
                throw new \Exception('Data not found');
            }

            $html = $this->renderView('invoice.html.twig', array(
               'orderInfos' => $orderInfos 
            ));

            return new PdfResponse(
                $pdf->getOutputFromHtml($html),
                'invoice-'.$orderid.'.pdf'
            );
        } catch (Exception $ex) {
            return $ex;
        }
    }
    
    /**
     * List of orders
     * 
     * @Route("/api/orders", name="orders", methods={"GET"})
     * @SWG\Response(
     *      response=200,
     *      description="Returns list of orders"
     * )
     * @SWG\Tag(name="orders")
     */
    public function orders()
    {
        $repo = $this->getDoctrine()->getRepository('\App\Entity\Orders');
        
        $ordersResults = $repo->findAll();
        
        $orders = array();
        
        foreach ($ordersResults as $ordersResult) {
            array_push($orders, array(
                'price_ht' => $ordersResult->getPriceht(),
                'price_ttc' => $ordersResult->getPricettc(),
                'date' => $ordersResult->getDate()->format('d-m-Y'),
                'customer' => array(
                    'firstname' => $ordersResult->getCustomer()->getFirstname(),
                    'lastname' => $ordersResult->getCustomer()->getLastname(),
                    'address' => $ordersResult->getCustomer()->getAddress(),
                    'postcode' => $ordersResult->getCustomer()->getPostcode(),
                    'city' => $ordersResult->getCustomer()->getCity(),
                    'country' => $ordersResult->getCustomer()->getCountry(),
                    'phone' => $ordersResult->getCustomer()->getPhone()
                )
            ));
        }
                
        return $this->json($orders);
    }
    
    /**
     * Get details of an order
     * 
     * @Route("/api/orders/{orderid}", name="order", methods={"GET"}) 
     * @SWG\Response(
     *      response=200,
     *      description="Returns order details"
     * )
     * @SWG\Tag(name="orders")
     * 
     */
    public function order(Request $request)
    {
        $orderid = $request->attributes->get('orderid');
        
        $repo = $this->getDoctrine()->getRepository('\App\Entity\Orders');
        
        $orderResult = $repo->find($orderid);
        
        $order = array(
            'price_ht' => $orderResult->getPriceht(),
            'price_ttc' => $orderResult->getPricettc(),
            'date' => $orderResult->getDate()->format('d-m-Y'),
            'customer' => array(
                'firstname' => $orderResult->getCustomer()->getFirstname(),
                'lastname' => $orderResult->getCustomer()->getLastname(),
                'address' => $orderResult->getCustomer()->getAddress(),
                'postcode' => $orderResult->getCustomer()->getPostcode(),
                'city' => $orderResult->getCustomer()->getCity(),
                'country' => $orderResult->getCustomer()->getCountry(),
                'phone' => $orderResult->getCustomer()->getPhone()
            )
        );
        
        return $this->json($order);
    }
}

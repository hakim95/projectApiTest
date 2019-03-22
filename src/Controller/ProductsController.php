<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class ProductsController extends AbstractController
{
    /**
     * List of products
     * 
     * @Route("/api/products", name="products", methods={"GET"})
     * @SWG\Response(
     *      response=200,
     *      description="Returns list of products"
     * )
     * @SWG\Tag(name="products")
     */
    public function products()
    {
        $repo = $this->getDoctrine()->getRepository('\App\Entity\Products');
        
        $productsResult = $repo->findAll();
        
        $products = array();
        
        foreach ($productsResult as $product) {
            array_push($products, array(
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'priceht' => $product->getPriceht(),
                'pricettc' => $product->getPricettc()
            ));
        }
        
        return $this->json($products);
    }
    
    /**
     * Get product details
     * 
     * @Route("/api/products/{productid}", name="product", methods={"GET"})
     * @SWG\Response(
     *      response=200,
     *      description="Return product detail"
     * )
     * @SWG\Tag(name="products")
     */
    public function product(Request $request)
    {
        $productid = $request->attributes->get('productid');
        
        $repo = $this->getDoctrine()->getRepository('\App\Entity\Products');
        
        $productResult = $repo->find($productid);
        
        $product = array(
            'name' => $productResult->getName(),
            'description' => $productResult->getDescription(),
            'priceht' => $productResult->getPriceht(),
            'pricettc' => $productResult->getPricettc()
        );
        
        return $this->json($product);
    }
}

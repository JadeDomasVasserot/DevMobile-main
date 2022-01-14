<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Category;

class ProductCategoryController extends AbstractController
{
    /**
     * @Route("/product/category", name="product_category", methods="GET")
     */
    public function index(): Response
    {   
        //recup toute les category
        $categorys = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        //recup tout les produits
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $render = array();
            
        foreach ($categorys as $cat ) 
        {
            foreach ($products as $product ) 
            {
                if($product->getCategorie() == $cat)
                {
                    $category = array(
                        'CategoryId' => $cat->getIdcat(),
                        'Name' => $cat->getName(),
                    );

                    $produit = array(
                        'productName' => $product->getName(),
                        'productId' => $product->getIdproduit(),
                        'productReference' => $product->getReference(),
                        'productUnitPrice' => $product->getUnitPrice(),
                        'productPicture' => $product->getPicture(),
                        'category' => $category,
                    );

                    array_push($render, $produit);
                }
            }
        }

        $response = new Response();
                $response->setContent(json_encode([$render]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

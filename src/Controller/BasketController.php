<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\ProductsInBasket;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketController extends AbstractController
{
    /**
     * @Route("/addtobasket/{quantity}/{idproduct}/{size}/{shoessize}", name="basket", methods={"GET"})
     */
    public function AddToBasket(int $quantity, int $idproduct, string $size, int $shoessize, SessionInterface $session)
    {
        
        $iduser = $session->get('id');
        $em = $this->getDoctrine()->getManager();

        try{
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $iduser,
                ]);

        
            $product =$this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy([
                    'idproduit' => $idproduct,
                ]);
        }
        catch (\Exception $err)
        {
            $response = new Response();


            return $response->setStatusCode(500);
        }
            
        $basket = new ProductsInBasket();
        $basket->setQuantity($quantity);
        $basket->setProduct($product);
        $basket->setUser($user);
        $basket->setSize($size);
        $basket->setShoessize($shoessize);
        
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($basket);
        $em->flush();

        $response = new Response();

        

        return $response->setStatusCode(200);
    }

    /**
     * @Route("/addtopanier/{quantity}/{idproduct}/{size}/{shoessize}/{iduser}", name="addtopanier", methods={"GET"})
     */
    public function AddToPanier(int $quantity, int $idproduct, string $size, int $shoessize, int $iduser, SessionInterface $session)
    {
        
        $em = $this->getDoctrine()->getManager();

        try{
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $iduser,
                ]);

        
            $product =$this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy([
                    'idproduit' => $idproduct,
                ]);
        }
        catch (\Exception $err)
        {
            $response = new Response();

           

            return $response->setStatusCode(500);
        }
            
        $basket = new ProductsInBasket();
        $basket->setQuantity($quantity);
        $basket->setProduct($product);
        $basket->setUser($user);
        $basket->setSize($size);
        $basket->setShoessize($shoessize);
        
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($basket);
        $em->flush();

        $response = new Response();

       

        return $response->setStatusCode(200);
    }

    /**
     * @Route("/returnpanier/{iduser}", name="ReturnPanier")
     */
    public function ReturnPanier(int $iduser):Response
    {
        
        try{

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $iduser,
                ]);

            $panier = $this->getDoctrine()
                ->getRepository(ProductsInBasket::class)
                ->findBy([
                    'user' => $user, 
                ]);
            
        }
        catch (\Exception $err)
        {
            $response = new Response();

          

            return $response->setStatusCode(500);
        }
        
        $produits = array();
        
        foreach($panier as $i)
        {
            $product = $i->getProduct();

            $produit = array(
                'productName' => $product->getName(),
                'productId' => $product->getIdproduit(),
                'productReference' => $product->getReference(),
                'productUnitPrice' => $product->getUnitPrice(),
                'productPicture' => $product->getPicture(),
                'size' => $i->getSize(),
                'shoesSize' => $i->getShoessize(),
                'quantity' => $i->getQuantity(),
                'IdProductInBasket' => $i->getIdpib(),

            );

            array_push($produits, $produit);
        }
                
        $response = new Response();


       

        $response->setContent(json_encode([$produits]));
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }

    /**
     * @Route("/returnbasket", name="ReturnBasket")
     */
    public function ReturnBasket(SessionInterface $session):Response
    {
        
        $iduser = $session->get('id');
        try{

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $iduser,
                ]);

            $panier = $this->getDoctrine()
            ->getRepository(ProductsInBasket::class)
            ->findBy([
                'user' => $user, 
            ]);
            
        }
        catch (\Exception $err)
        {
            $response = new Response();

           

            return $response->setStatusCode(500);
        }
        
        $produits = array();
        
        foreach($panier as $i)
        {
            $product = $i->getProduct();

            $produit = array(
                'productName' => $product->getName(),
                'productId' => $product->getIdproduit(),
                'productReference' => $product->getReference(),
                'productUnitPrice' => $product->getUnitPrice(),
                'productPicture' => $product->getPicture(),
            );

            array_push($produits, $produit);
        }
                
        $response = new Response();

       

        $response->setContent(json_encode([$produits]));
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }
    
    /**
     * @Route("/deleteinbasket/{idpib}", name="DeleteInBasket")
     */
    public function DeleteInBasket(int $idpib, SessionInterface $session)
    {
        $iduser = $session->get('id');

        try{

            //recherchee du panier correspondant a l'id en parametre
            $productInBasket = $this->getDoctrine()
                ->getRepository(ProductsInBasket::class)
                ->findOneBy([
                    'idpib' => $idpib,
                    'user' => $iduser,
                ]);
        }
        catch (\Exception $err)
        {
            $response = new Response();

            

            return $response->setStatusCode(500);
        }
        

        $em = $this->getDoctrine()->getManager();
        $em->remove($productInBasket);
        $em->flush();

        $response = new Response();

       

        $response->setStatusCode(200);
        return $response;        
    }

    /**
     * @Route("/deleteinbasket/{idpib}/{iduser}", name="DeleteInBasket")
     */
    public function DeleteInBasketID(int $idpib, int $iduser)
    {
        try{

            //recherchee du panier correspondant a l'id en parametre
            $productInBasket = $this->getDoctrine()
                ->getRepository(ProductsInBasket::class)
                ->findOneBy([
                    'idpib' => $idpib,
                    'user' => $iduser,
                ]);
        }
        catch (\Exception $err)
        {
            $response = new Response();

            return $response->setStatusCode(500);
        }
        

        $em = $this->getDoctrine()->getManager();
        $em->remove($productInBasket);
        $em->flush();

        $response = new Response();

        $response->setStatusCode(200);
        return $response;        
    }
    
    /**
     * @Route("/modifybasket/{idpib}/{quantity}", name="ModifyBasket")
     */
    public function ModifyBasket(int $idpib, int $quantity, SessionInterface $session)
    {
        $iduser = $session->get('id');

        if($quantity > 0 )
        {
            try{
               
                $productInBasket = $this->getDoctrine()
                ->getRepository(ProductsInBasket::class)
                ->findOneBy([
                    'idpib' => $idpib,
                    'user' => $iduser,
                ]);
            }
            catch (\Exception $err)
            {
                $response = new Response();

                $response->setStatusCode(500);
                return $response;
            }
            

            $em = $this->getDoctrine()->getManager();
            $productInBasket->setQuantity($quantity);
            $em->flush();

            $response = new Response();

            $response->setStatusCode(200);
            return $response;
        }
        else
        {
            $this->DeleteInBasket($idpib,$session);
        }

        $response = new Response();

        $response->setStatusCode(200);
        return $response;
        
    }

    /**
     * @Route("/modifybasket/{idpib}/{quantity}/{iduser}", name="ModifyBasket")
     */
    public function ModifyBasketID(int $idpib, int $quantity, int $iduser)
    {
        if($quantity > 0 )
        {
            try{
               
                $productInBasket = $this->getDoctrine()
                ->getRepository(ProductsInBasket::class)
                ->findOneBy([
                    'idpib' => $idpib,
                    'user' => $iduser,
                ]);
            }
            catch (\Exception $err)
            {
                $response = new Response();

                $response->setStatusCode(500);
                return $response;
            }
            

            $em = $this->getDoctrine()->getManager();
            $productInBasket->setQuantity($quantity);
            $em->flush();

            $response = new Response();

            $response->setStatusCode(200);
            return $response;
        }
        else
        {
            $this->DeleteInBasketID($idpib, $iduser);
        }

        $response = new Response();

        $response->setStatusCode(200);
        return $response;
        
    }
}
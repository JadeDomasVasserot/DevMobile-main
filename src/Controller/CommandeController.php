<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;
use App\Entity\User;
use App\Entity\ProductOrdered;
use App\Entity\Product;
use App\Entity\ProductsInBasket;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande/index", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

        /**
     * @Route("/commande", name="PasserCommande")
     */
    public function PasserCommande(SessionInterface $session)
    {
        $id = $session->get('id');

        date_default_timezone_set('UTC');

        
        $number = rand(0,1000) + rand(0,1000);
        $totalAv = 0;
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $panier = $this->getDoctrine()
            ->getRepository(ProductsInBasket::class)
            ->findBy([
                'user' => $user
            ]);

        $marge = $user->getMargin();

        foreach($panier as $i){

            $totalAv += $i->getProduct()->getUnitprice();

            //Suprimme les Producte in basket 
            $entityManager->remove($i);
        }

        //calcul le total
            $total = $totalAv - (($totalAv/100) * $marge);
        
        //cree la commande 
            $order = new Commande();
            $order->setNumber($number);
            $order->setAmountoutmargin($totalAv);
            $order->setCommargin($marge);
            $order->setTotalamount($total);
            $order->setUser($user);

            $entityManager->persist($order);

        //cree la relation commande produit 
            foreach ($panier as $i){
                $ProductOrdered = new ProductOrdered(); 
                $ProductOrdered->setCommande($order);
                $ProductOrdered->setProduct($i->getProduct());
                $ProductOrdered->setShoessize($i->getShoessize());
                $ProductOrdered->setSize($i->getSize());
                $ProductOrdered->setQuantite($i->getQuantity());


                $entityManager->persist($ProductOrdered);
            } 

        $entityManager->flush();

        $response = new Response();
       
        $response->setStatusCode(200);
        return $response;
    }

    /**
     * @Route("/commande/{id}", name="PasserCommandeID")
     */
    public function PasserCommandeID(int $id)
    {
        date_default_timezone_set('UTC');

        $date = new \DateTime();
        
        $number = rand(0,1000) + rand(0,1000);
        $totalAv = 0;
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $panier = $this->getDoctrine()
            ->getRepository(ProductsInBasket::class)
            ->findBy([
                'user' => $user
            ]);
        
        //if ($panier != null) {
            $marge = $user->getMargin();

            foreach($panier as $i){

                $totalAv += $i->getProduct()->getUnitprice();

                //Suprimme les Producte in basket 
                $entityManager->remove($i);
            }

            //calcul le total
                $total = $totalAv - (($totalAv/100) * $marge);
            
            //cree la commande 
                $order = new Commande();
                $order->setNumber($number);
                $order->setDate($date);
                $order->setAmountoutmargin($totalAv);
                $order->setCommargin($marge);
                $order->setTotalamount($total);
                $order->setUser($user);

                $entityManager->persist($order);

            //cree la relation commande produit 
                foreach ($panier as $i){
                    $ProductOrdered = new ProductOrdered(); 
                    $ProductOrdered->setCommande($order);
                    $ProductOrdered->setProduct($i->getProduct());
                    $ProductOrdered->setShoessize($i->getShoessize());
                    $ProductOrdered->setSize($i->getSize());
                    $ProductOrdered->setQuantite($i->getQuantity());


                    $entityManager->persist($ProductOrdered);
                } 

            $entityManager->flush();

            $response = new Response();
            $response->setStatusCode(200);
            return $response;

        // }else {
        //     $response = new Response();
        //     $response->setStatusCode(500);
        //     return $response;
        // }

        
    }


    /**
     * @Route("/return/commande/{id}", name="ReturnCommande")
     */
    public function ReturnCommande(int $id)
    {

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        
        $commandes = $this->getDoctrine()
            ->getRepository(Commande::class)
            ->findAll();
        
        $CommandesUser = array();
        
        foreach ($commandes as $commande){
            if($commande->getUser()->getId() == $user->getId()){
                $co = array(
                    'id' => $commande->getIdcommande(),
                    'date' => $commande->getDate(),
                    'number' => $commande->getNumber(),
                    'amountoutmargin' => $commande->getAmountoutmargin(),
                    'commargin' => $commande->getCommargin(),
                    'totalamount' => $commande->getTotalamount(),
                );
                array_push($CommandesUser, $co);
            }
        }

        $response = new Response();
        $response->setContent(json_encode([$CommandesUser]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/return/produit/commande/{idcommande}", name="ReturnProduitCommande")
     */
    public function ReturnProduitCommande(int $idcommande):Response
    {
        
        try{

            $commande = $this->getDoctrine()
                ->getRepository(Commande::class)
                ->findOneBy([
                    'idcommande' => $idcommande,
                ]);

            $productOrdereds = $this->getDoctrine()
                ->getRepository(ProductOrdered::class)
                ->findBy([
                    'commande' => $commande,
            ]);


            $produits = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();
            
        }
        catch (\Exception $err)
        {
            $response = new Response();
            return $response->setStatusCode(500);
        }
        
        $produitsCommande = array();
        
        foreach($productOrdereds as $productOrdered)
        {
            foreach ($produits as $product) {
                if ($product == $productOrdered->getProduct()){
                    $produit = array(
                        'productName' => $product->getName(),
                        'productId' => $product->getIdproduit(),
                        'productReference' => $product->getReference(),
                        'productUnitPrice' => $product->getUnitPrice(),
                        'productPicture' => $product->getPicture(),
                        'size' => $productOrdered->getSize(),
                        'shoesSize' => $productOrdered->getShoessize(),
                        'quantity' => $productOrdered->getQuantite(),
        
                    );
                    array_push($produitsCommande,$produit );
                }
            }
        }
                
        $response = new Response();
        $response->setContent(json_encode([$produitsCommande]));
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }
}

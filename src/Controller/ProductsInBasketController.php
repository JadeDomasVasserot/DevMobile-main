<?php

namespace App\Controller;

use App\Entity\ProductsInBasket;
use App\Form\ProductsInBasket2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/products/in/basket")
 */
class ProductsInBasketController extends AbstractController
{
    /**
     * @Route("/", name="products_in_basket_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $productsInBaskets = $entityManager
            ->getRepository(ProductsInBasket::class)
            ->findAll();

        return $this->render('products_in_basket/index.html.twig', [
            'products_in_baskets' => $productsInBaskets,
        ]);
    }

    /**
     * @Route("/new", name="products_in_basket_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productsInBasket = new ProductsInBasket();
        $form = $this->createForm(ProductsInBasket2Type::class, $productsInBasket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productsInBasket);
            $entityManager->flush();

            return $this->redirectToRoute('products_in_basket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('products_in_basket/new.html.twig', [
            'products_in_basket' => $productsInBasket,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idpib}", name="products_in_basket_show", methods={"GET"})
     */
    public function show(ProductsInBasket $productsInBasket): Response
    {
        return $this->render('products_in_basket/show.html.twig', [
            'products_in_basket' => $productsInBasket,
        ]);
    }

    /**
     * @Route("/{idpib}/edit", name="products_in_basket_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProductsInBasket $productsInBasket, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductsInBasket2Type::class, $productsInBasket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('products_in_basket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('products_in_basket/edit.html.twig', [
            'products_in_basket' => $productsInBasket,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idpib}", name="products_in_basket_delete", methods={"POST"})
     */
    public function delete(Request $request, ProductsInBasket $productsInBasket, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productsInBasket->getIdpib(), $request->request->get('_token'))) {
            $entityManager->remove($productsInBasket);
            $entityManager->flush();
        }

        $response = new Response();
        $response->setStatusCode(200);
        return $response;
    }
}

<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/produits', name: 'products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('products/index.html.twig', [
            'product' => $productsRepository->findBy([], ['id' => 'asc']),
        ]);
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Products $products): Response
    {
        return $this->render('products/details.html.twig', compact('products'));
    }
}

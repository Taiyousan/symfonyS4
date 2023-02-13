<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class FournisseurController extends AbstractController
{
    #[Route('/fournisseur', name: 'app_fournisseur_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);

        $form->handleRequest($request); // hydratation du form 
            if($form->isSubmitted() && $form->isValid()){ 
                $entityManager->persist($fournisseur); // on effectue les mise à jours internes
              $entityManager->flush(); 
                var_dump('bien envoyé');
            }
        return $this->render('fournisseur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    
}

    

    
}

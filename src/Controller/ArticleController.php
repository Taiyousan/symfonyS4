<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article, [
            'codePostal' => '10000'
        ]);

        $form->handleRequest($request); // hydratation du form 
            if($form->isSubmitted() && $form->isValid()){ 
                $entityManager->persist($article); // on effectue les mise à jours internes
              $entityManager->flush(); 
                var_dump('bien envoyé');
            }
        return $this->render('article/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

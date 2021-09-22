<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function articleList(ArticleRepository $repo, Request $req): Response
    {
        $articleList = $repo->findAll();

        $article = new Article();

        $formArticle = $this->createForm(ArticleType::class, $article);

        $formArticle->handleRequest($req);
        if ($formArticle->isSubmitted()) {
            $article->setIsCheck(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('main/list.html.twig', [
            'articleList' => $articleList,
            'formArticle' => $formArticle->createView()
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Article $article, EntityManagerInterface $em): Response
    {
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/check/{id}", name="check")
     */
    public function check(Article $article, EntityManagerInterface $em): Response
    {
        $article->getIsCheck() ? $article->setIsCheck(false) : $article->setIsCheck(true);
        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}

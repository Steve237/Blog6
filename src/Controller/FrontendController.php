<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Figures;
use App\Form\CommentType;
use App\Repository\ImageRepository;
use App\Repository\FiguresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class FrontendController extends AbstractController {


    /**
     * Permet d'afficher la liste des articles sur la page accueil
     * @Route("/", name="accueil", methods={"GET"})
     */
    public function index(FiguresRepository $figuresRepository, ImageRepository $imagerepo, PaginatorInterface $paginatorInterface, Request $request): Response
    {       
        $figures = $paginatorInterface->paginate(
            $figuresRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );
        return $this->render('figures/index.html.twig', [
            'figures' => $figures,
            'images' => $imagerepo->findAll()
            
        ]);
    }

    /**
     * Permet d'afficher un article spécifique et les commentaires associés
     * @Route("/figure-{slug}", name="figure")
     */
    public function show(Figures $figures, Request $request, EntityManagerInterface $entityManager): Response
    {   
        $comment = new Comment();
        
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment->setFigure($figures)
                    ->setUser($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->render('figures/show.html.twig', [
            'figures' => $figures,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de charger plus de commentaires
     * @Route("/figure-{id}/{start}", name="loadMoreComments", requirements={"start": "\d+"})
     */
    public function loadMoreComments(FiguresRepository $repo, $id, $start = 5)
    {
        $figures = $repo->findOneById($id);

        return $this->render('figures/loadMoreComments.html.twig', [
            'figures' => $figures,
            'start' => $start
        ]);
    }
}

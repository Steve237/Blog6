<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Figures;
use App\Form\FigureType;
use App\Form\FiguresType;
use App\Repository\ImageRepository;
use App\Repository\FiguresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FiguresController extends AbstractController
{
    /**
     * Permet d'afficher la liste des articles sur la page accueil
     * @Route("/", name="accueil", methods={"GET"})
     */
    public function index(FiguresRepository $figuresRepository, ImageRepository $imagerepo): Response
    {
        return $this->render('figures/index.html.twig', [
            'figures' => $figuresRepository->findAll(),
            'images' => $imagerepo->findAll()
        ]);
    }

    /**
     * Permet d'afficher une page spécifique
     * @Route("/{id}", name="figure", methods={"GET"})
     */
    public function show(Figures $figures): Response
    {
        return $this->render('figures/show.html.twig', [
            'figures' => $figures,
        ]);
    }

    
    /**
     * Permet d'ajouter une nouvelle figure
     * @Route("/admin/create", name="create", methods={"GET","POST"})
     * @return Response
     */
    public function Create(Request $request, EntityManagerInterface $entityManager): Response {

        $figure = new Figures();

        $form = $this->createForm(FigureType::class, $figure);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($figure->getImages() as $image) {

                $image->setFigure($figure);
                $entityManager->persist($image);
            }
                $entityManager->persist($figure);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    "<strong>La figure a bien été ajouté!</strong>"
                );

                return $this->redirectToRoute('accueil');
        }

        return $this->render('figures/create.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
        ]);
    }


    /** Permet d'afficher le formulaire de modification
     * @Route("/admin/{id}/update", name="update")
     */
    public function update(Figures $figure, Request $request, EntityManagerInterface $entityManager) {

        $form = $this->createForm(FigureType::class, $figure);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($figure->getImages() as $image) {

                $image->setFigure($figure);
                $entityManager->persist($image);
            }
                $entityManager->persist($figure);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    "<strong>La figure a bien été modifié!</strong>"
                );

                return $this->redirectToRoute('accueil');
        }

        return $this->render('figures/edit.html.twig', [

            'form' => $form->createView()
        ]);

    }
    
    /**
     * @Route("/{id}", name="figures_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Figures $figure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$figure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($figure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('figures_index');
    }


    /**
    * Permet de modifier l'image à la une
    * @Route("/figure/modif/{id}", name="modification_imageTop", methods="GET|POST")
    */
    public function Modification(Figures $figures, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(ImageTopType::class, $figures);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($figures);
            $objectManager->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('figure/modifImage.html.twig', [
            "figures" => $figures,
            "form" => $form->createView()

        ]);
    }
}

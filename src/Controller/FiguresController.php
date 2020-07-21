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
     * @Route("/{id}", name="figure", methods={"GET"})
     */
    public function show(Figures $figures): Response
    {
        return $this->render('figures/show.html.twig', [
            'figures' => $figures,
        ]);
    }

    /**
     * @Route("/admin/create", name="create", methods={"GET","POST"})
     * @return Response
     */
    public function Create(Request $request): Response {

        $figure = new Figures();
        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //On récupère les images transmises
            $images = $form->get('image')->getData();

            //On boucle sur les images
            foreach($images as $image) {
                //on génère un nouveau fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            
                //On copie le fichier dans le dossier img/figure
                $image->move(
                $this->getParameter('images_directory'),
                $fichier
                );
                
                //On stocke l'image dans la base de données
                $img = new Image();
                $img->setImageFigure($fichier);
                $figure->addImage($img);
            }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($figure);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
        }

        return $this->render('figures/create.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="figures_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $figure = new Figures();
        $form = $this->createForm(FiguresType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //On récupère les images transmises
            $images = $form->get('image')->getData();

            //On boucle sur les images
            foreach($images as $image) {
                //on génère un nouveau fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            
                //On copie le fichier dans le dossier img/figure
                $image->move(
                $this->getParameter('images_directory'),
                $fichier
                );
                
                //On stocke l'image dans la base de données
                $img = new Image();
                $img->setImageFigure($fichier);
                $figure->addImage($img);
            }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($figure);
                $entityManager->flush();

                return $this->redirectToRoute('figures_index');
        }

        return $this->render('figures/new.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="figures_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Figures $figure): Response
    {
        $form = $this->createForm(FiguresType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //On récupère les images transmises
            $images = $form->get('image')->getData();

            //On boucle sur les images
            foreach($images as $image) {
                //on génère un nouveau fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            
                //On copie le fichier dans le dossier img/figure
                $image->move(
                $this->getParameter('images_directory'),
                $fichier
                );
                
                //On stocke l'image dans la base de données
                $img = new Image();
                $img->setImageFigure($fichier);
                $figure->addImage($img);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('figures_index');
        }

        return $this->render('figures/edit.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
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

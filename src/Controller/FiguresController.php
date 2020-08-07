<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Figures;
use App\Form\ImageType;
use App\Form\VideoType;
use App\Form\FigureType;
use App\Form\FiguresType;
use App\Form\ImageTopType;
use App\Form\AddFigureType;
use App\Form\UpdateFigureType;
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
            'figures' => $figures
        ]);
    }

    
    /**
     * Permet d'ajouter une nouvelle figure
     * @Route("/admin/create", name="create", methods={"GET","POST"})
     * @return Response
     */
    public function Create(Request $request, EntityManagerInterface $entityManager): Response {

        $figure = new Figures();

        $form = $this->createForm(AddFigureType::class, $figure);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($figure->getImages() as $image) {

                $image->setFigure($figure);
                $entityManager->persist($image);
            }

            foreach($figure->getVideos() as $video) {

                $video->setFigure($figure);
                $entityManager->persist($video);
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
            'figures' => $figure,
            'form' => $form->createView()
        ]);
    }


    /** 
     * Permet d'afficher le formulaire de modification
     * @Route("/admin/{id}/update", name="update")
     */
    public function update(Figures $figure, Request $request, EntityManagerInterface $entityManager) {

        $form = $this->createForm(UpdateFigureType::class, $figure);

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

            'form' => $form->createView(),
            'figures' => $figure
        ]);

    }
    
    /**
     * Permet de supprimer une annonce
     * @Route("/admin/{id}/delete", name="figure_delete")
     * 
    */
    public function delete(Figures $figure, EntityManagerInterface $entityManager): Response
    {
       $entityManager->remove($figure);
       $entityManager->flush();

       $this->addFlash(
        'success',
        "L'annonce a bien été supprimé"
        );
        
        return $this->redirectToRoute('accueil');
    }

    /**
     * Permet de supprimer une image
     * @Route("/admin/{id}/delete_image", name="image_delete")
     * 
    */
    public function deleteImage(Image $image, EntityManagerInterface $entityManager): Response
    {
       $entityManager->remove($image);
       $entityManager->flush();

       $this->addFlash(
        'success',
        "L'image a bien été supprimé"
        );
        
        return $this->redirectToRoute('accueil');
    }


    /**
     * Permet de supprimer une video
     * @Route("/admin/{id}/delete_video", name="video_delete")
     * 
    */
    public function deleteVideo(Video $video, EntityManagerInterface $entityManager): Response
    {
       $entityManager->remove($video);
       $entityManager->flush();

       $this->addFlash(
        'success',
        "La video a bien été supprimé"
        );
        
        return $this->redirectToRoute('accueil');
    }


    /**
     * Permet de modifier l'image
     * @Route("/figure/update/{id}", name="update_image", methods="GET|POST")
    */
    public function UpdateImage(Image $image, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($image);
            $objectManager->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('figures/updateimage.html.twig', [
            "image" => $image,
            "form" => $form->createView()

        ]);
    }
    
    /**
     * Permet de modifier la video
     * @Route("/figure/updatevideo/{id}", name="update_video", methods="GET|POST")
    */
    public function UpdateVideo(Video $video, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(VideoType::class, $video);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($video);
            $objectManager->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('figures/updatevideo.html.twig', [
            "video" => $video,
            "form" => $form->createView()

        ]);
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
        return $this->render('figures/modifImage.html.twig', [
            "figures" => $figures,
            "form" => $form->createView()

        ]);
    }

}

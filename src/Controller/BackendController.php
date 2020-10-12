<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Figures;
use App\Form\ImageType;
use App\Form\VideoType;
use App\Form\ImageTopType;
use App\Form\AddFigureType;
use App\Form\UpdateFigureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class BackendController extends AbstractController
{
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
     * @Route("/admin/update-figure-{slug}", name="update")
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

                return $this->redirectToRoute('figure',  array('slug' => $figure->getSlug()));
        }

        return $this->render('figures/edit.html.twig', [

            'form' => $form->createView(),
            'figures' => $figure
        ]);

    }
    
    
    /**
     * Permet de modifier l'image de la figure
     * @Route("/admin/update-image-{idimage}/figure-{slug}", name="update_image", methods="GET|POST")
     * @ParamConverter("image", options={"mapping": {"idimage" : "id"}})
     * @ParamConverter("figures", options={"mapping": {"slug"   : "slug"}})
    */
    public function UpdateImage(Image $image, Figures $figures, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($image);
            $objectManager->flush();

            $this->addFlash(
                'success',
                "L'image a bien été modifié"
                );
                
            return $this->redirectToRoute('update',  array('slug' => $figures->getSlug()));


        }
        return $this->render('figures/updateimage.html.twig', [
            "figures" =>$figures,
            "image" => $image,
            "form" => $form->createView()

        ]);
    }


    /**
     * Permet de modifier la video
     * @Route("/admin/update-video-{idvideo}/figure-{slug}", name="update_video", methods="GET|POST")
     * @ParamConverter("video", options={"mapping": {"idvideo" : "id"}})
     * @ParamConverter("figures", options={"mapping": {"slug"   : "slug"}})
    */
    public function UpdateVideo(Video $video, Figures $figures, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(VideoType::class, $video);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($video);
            $objectManager->flush();

            $this->addFlash(
                'success',
                "La vidéo a bien été modifié"
                );
                
            return $this->redirectToRoute('update',  array('slug' => $figures->getSlug()));
        }
        return $this->render('figures/updatevideo.html.twig', [
            "figures" =>$figures,
            "video" => $video,
            "form" => $form->createView()

        ]);
    }


    /**
     * Permet de supprimer une annonce
     * @Route("/admin/delete/{slug}", name="figure_delete")
     * 
    */
    public function delete(Figures $figure, EntityManagerInterface $entityManager): Response
    {
       $entityManager->remove($figure);
       $entityManager->flush();

       $this->addFlash(
        'success', "L'annonce a bien été supprimée"
        );
        
        return $this->redirectToRoute('accueil');
    }

    /**
     * Permet de supprimer une image
     * @Route("/admin/delete_image-{idimage}/figure-{slug}", name="image_delete")
     * @ParamConverter("image", options={"mapping": {"idimage" : "id"}})
     * @ParamConverter("figures", options={"mapping": {"slug"   : "slug"}})
    */
    public function deleteImage(Image $image, Figures $figures, EntityManagerInterface $entityManager): Response
    {
       $entityManager->remove($image);
       $entityManager->flush();

       $this->addFlash(
        'success', "L'image a bien été supprimée"
        );
        
        return $this->redirectToRoute('update',  array('slug' => $figures->getSlug()));

    }


    /**
     * Permet de supprimer une video
     * @Route("/admin/delete-video-{idvideo}/figure-{slug}", name="video_delete")
     * @ParamConverter("video", options={"mapping": {"idvideo" : "id"}})
     * @ParamConverter("figures", options={"mapping": {"slug" : "slug"}})
    */
    public function deleteVideo(Video $video, Figures $figures, EntityManagerInterface $entityManager): Response
    {
       $entityManager->remove($video);
       $entityManager->flush();

       $this->addFlash(
        'success', "La video a bien été supprimée"
        );
        
        return $this->redirectToRoute('update',  array('slug' => $figures->getSlug()));
    }

    /**
     * Permet de modifier l'image à la une
     * @Route("/admin/update-image-top-{slug}", name="modification_imageTop", methods="GET|POST")
    */
    public function Modification(Figures $figures, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(ImageTopType::class, $figures);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($figures);
            $objectManager->flush();
            
            return $this->redirectToRoute('update',  array('slug' => $figures->getSlug()));

        }
        return $this->render('figures/modifImage.html.twig', [
            "figures" => $figures,
            "form" => $form->createView()

        ]);
    }

    
    /**
    * @Route("/admin/delete-image/{slug}", name="delete_imagetop")
    */
    public function deleteImageTop(Figures $figures, EntityManagerInterface $entityManager): Response
    {  
       $figures->setImageTop(NULL);      
       $entityManager->flush();
        
       $this->addFlash(
        'success',
        "L'image a bien été supprimée"
        );
        
        return $this->redirectToRoute('update',  array('slug' => $figures->getSlug()));

    }
}

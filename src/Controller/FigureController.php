<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Figures;
use App\Form\ImageType;
use App\Form\ImageTopType;
use App\Form\FigureType;
use App\Repository\FiguresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FigureController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(FiguresRepository $repository)
    {   
        $figures = $repository->findAll();
        
        return $this->render('figure/index.html.twig', [
            
            "figures" => $figures
        ]);
    }

    /**
    * @Route("/figure/{id}", name="figure")
    */
    public function figure(Figures $figures)
    {   
        return $this->render('figure/figure.html.twig', [

            "figures" => $figures
        ]);
    
    }

    /**
    * @Route("/figure/modif/{id}", name="modification_imageTop")
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


     /**
    * @Route("/figure/modif/{id}", name="modification_image", methods="GET|POST")
    */
    public function ModificationImage(Figures $figures, Request $request, EntityManagerInterface $objectManager)
    {   

        $form = $this->createForm(FigureType::class, $figures);

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

    /**
    * @Route("/figure/modif/{id}", name="suppression_figure", methods="delete")
    * 
    */
    public function suppressionImage1(Figures $figures, Request $request,  EntityManagerInterface $objectManager)
    {   
        $objectManager->remove($figures);
        $objectManager->flush();
        return $this->redirectToRoute("accueil");
    }

}
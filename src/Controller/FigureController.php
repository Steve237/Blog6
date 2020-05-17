<?php

namespace App\Controller;

use App\Entity\Figures;
use App\Repository\FiguresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function figure(FiguresRepository $repository, $id)
    {   
        $figure = $repository->find($id);
        return $this->render('figure/figure.html.twig', [

            "figure" => $figure
        ]);
    
    }

}

<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Groupe;
use App\Entity\Figures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FiguresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { 
        $img1 = new Image();
        $img1->setImageFigure("Method1.jpg");
        $manager->persist($img1);

        $img2 = new Image();
        $img2->setImageFigure("Twist1.jpg");
        $manager->persist($img2);

        $img3 = new Image();
        $img3->setImageFigure("Flip1.jpg");
        $manager->persist($img3);

        $img4 = new Image();
        $img4->setImageFigure("Cork1.jpg");
        $manager->persist($img4);

        $video1 = new Video();
        $video1->setVideoName("Method.mp4");
        $manager->persist($video1);

        $video2 = new Video();
        $video2->setVideoName("Twist.mp4");
        $manager->persist($video2);

        $video3 = new Video();
        $video3->setVideoName("Flip.mp4");
        $manager->persist($video3);

        $video4 = new Video();
        $video4->setVideoName("Cork.mp4");
        $manager->persist($video4);

        $groupe1 = new Groupe();
        $groupe1->setLibelle("Air");
        $manager->persist($groupe1);

        $groupe2 = new Groupe();
        $groupe2->setLibelle("Flip");
        $manager->persist($groupe2);

        $groupe3 = new Groupe();
        $groupe3->setLibelle("One Foot");
        $manager->persist($groupe3);

        $groupe4 = new Groupe();
        $groupe4->setLibelle("Cork");
        $manager->persist($groupe4);


        $fig1 = new Figures();
        $fig1->setNomFigure("Method Air")
              ->setDescription("Cette figure qui consiste à attraper sa planche d'une main et le tourner perpendiculairement au sol – est un classique old school. Il n'empêche qu'il est indémodable.")
              ->setGroupe($groupe1)
              ->setImageTop("Method1.jpg")
              ->addImage($img1)
              ->addVideo($video1)
            ;
        $manager->persist($fig1);

        $fig2 = new Figures();
        $fig2->setNomFigure("Double Mc Twist 1260")
              ->setDescription("Le Mc Twist est un flip (rotation verticale) agrémenté d'une vrille. Un saut très périlleux réservé aux professionnels.")
              ->setGroupe($groupe2)
              ->setImageTop("Twist1.jpg")
              ->addImage($img2)
              ->addVideo($video2)
            ;
        $manager->persist($fig2);

        $fig3 = new Figures();
        $fig3->setNomFigure("Double Backflip One Foot")
              ->setDescription("Comme on peut le deviner, les one foot sont des figures réalisées avec un pied décroché de la fixation. Pendant le saut, le snowboarder doit tendre la jambe du côté dudit pied.")
              ->setGroupe($groupe3)
              ->setImageTop("Flip1.jpg")
              ->addImage($img3)
              ->addVideo($video3)
            ;
        $manager->persist($fig3);


        $fig4 = new Figures();
        $fig4->setNomFigure("Backside Triple Cork 1440")
              ->setDescription("En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011.")
              ->setGroupe($groupe4)
              ->setImageTop("Cork1.jpg")
              ->addImage($img4)
              ->addVideo($video4)
            ;
        $manager->persist($fig4);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

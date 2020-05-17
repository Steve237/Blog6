<?php

namespace App\DataFixtures;

use App\Entity\Figures;
use App\Entity\Groupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FiguresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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
              ->setImage1("Method1.jpg")
              ->setImage2("Method2.jpg")
              ->setVideo("Method.mp4")
              ->setGroupe($groupe1)
            ;
        $manager->persist($fig1);

        $fig2 = new Figures();
        $fig2->setNomFigure("Double Mc Twist 1260")
              ->setDescription("Le Mc Twist est un flip (rotation verticale) agrémenté d'une vrille. Un saut très périlleux réservé aux professionnels.")
              ->setImage1("Twist1.jpg")
              ->setImage2("Twist2.jpg")
              ->setVideo("Twist.mp4")
              ->setGroupe($groupe2)
            ;
        $manager->persist($fig2);

        $fig3 = new Figures();
        $fig3->setNomFigure("Double Backflip One Foot")
              ->setDescription("Comme on peut le deviner, les one foot sont des figures réalisées avec un pied décroché de la fixation. Pendant le saut, le snowboarder doit tendre la jambe du côté dudit pied.")
              ->setImage1("Flip1.jpg")
              ->setImage2("Flip2.jpg")
              ->setVideo("Flip.mp4")
              ->setGroupe($groupe3)
            ;
        $manager->persist($fig3);


        $fig4 = new Figures();
        $fig4->setNomFigure("Backside Triple Cork 1440")
              ->setDescription("En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011.")
              ->setImage1("Cork1.jpg")
              ->setImage2("Cork2.jpg")
              ->setVideo("Cork.mp4")
              ->setGroupe($groupe4)
            ;
        $manager->persist($fig4);
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

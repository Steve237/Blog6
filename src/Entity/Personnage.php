<?php
namespace App\Entity;

class Personnage {

    public $nom;
    public $prenom;
    public $sexe;
    public $carac = [];

    public static $personnages = [];
    
    public function __construct($nom, $prenom, $sexe, $carac) {

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->carac = $carac;
        self::$personnages[] = $this;
    }

    public static function creerPersonnage()
    {
        $p1 = new Personnage("Jules", "Essama", "homme", [
            "intel" => 10,
            "force" => 15,
            "agi" => 7
        ]);


        $p2 = new Personnage("Martin", "Lucienne", "femme", [
            "intel" => 10,
            "force" => 25,
            "agi" => 12
        ]);
    }

    public static function getPersonnageParNom($nom)
    {
        foreach (self::$personnages as $perso) {
            
            if (strtolower($perso->nom) == $nom) {

                return $perso;
            }
        }
    }

}
<?php

namespace App\DataFixtures;

use App\Entity\Stadium;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class StadiumFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group1'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $stadium1 = new Stadium();
        $stadium1->setName("Stade de la Fourragère")
                ->setAdress("14 rue Louis Reybaud")
                ->setPostalCode("13012")
                ->setTown("Marseille");
        $manager->persist($stadium1);
    
        $stadium2 = new Stadium();
        $stadium2->setName("Stade Jean Bouissou")
                ->setAdress("150 bd de Clavel")
                ->setPostalCode("13600")
                ->setTown("La Ciotat");
        $manager->persist($stadium2);
    
        $stadium3 = new Stadium();
        $stadium3->setName("Stade Albert Eynaud")
                ->setAdress("47 av du Maréchal de Lattre de Tassigny")
                ->setPostalCode("13009")
                ->setTown("Marseille");
        $manager->persist($stadium3);
    
        $stadium4 = new Stadium();
        $stadium4->setName("Stade Malpassé")
                ->setAdress("63 bd Lavéran")
                ->setPostalCode("13013")
                ->setTown("Marseille");
        $manager->persist($stadium4);

        

        
       
        $manager->flush();
    }
}



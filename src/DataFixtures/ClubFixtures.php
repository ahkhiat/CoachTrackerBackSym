<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ClubFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group2'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $club1 = new Club();
        $club1->setName('ES La Ciotat')
                ->setAdress("15 rue Louis Reybaud")
                ->setPostalCode("13600")
                ->setTown("La Ciotat");
        $manager->persist($club1);

        $club2 = new Club();
        $club2->setName('FCLM Malpassé')
                ->setAdress("63 bd Lavééran")
                ->setPostalCode("13013")
                ->setTown("Marseille");
        $manager->persist($club2);

        $club3 = new Club();
        $club3->setName('FC Mazargues')
                ->setAdress("47 av de Lattre de Tassigny")
                ->setPostalCode("13009")
                ->setTown("Marseille");
        $manager->persist($club3);

        $club4 = new Club();
        $club4->setName('Olympique de Marseille')
                ->setAdress("92 rue Jules Isaac")
                ->setPostalCode("13009")
                ->setTown("Marseille");
        $manager->persist($club4);

        $club5 = new Club();
        $club5->setName('AS La Bombardière')
                ->setAdress("201 rue Charles Kaddouz")
                ->setPostalCode("13012")
                ->setTown("Marseille");
        $manager->persist($club5);

        $club6 = new Club();
        $club6->setName('SO Caillolais')
                ->setAdress("1 chemin du cimetière")
                ->setPostalCode("13012")
                ->setTown("Marseille");
        $manager->persist($club6);
       
        $manager->flush();
    }
}



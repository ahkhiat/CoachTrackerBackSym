<?php

namespace App\DataFixtures;

use App\Entity\AgeCategory;
use App\Entity\Club;
use App\Entity\VisitorTeam;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class VisitorTeamFixtures extends Fixture implements FixtureGroupInterface

{
    public static function getGroups(): array
    {
        return ['group2'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $team1 = new VisitorTeam();
        $team1->setClub($manager->getRepository(Club::class)->findOneBy(['name' => 'ES La Ciotat']))
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($team1);

        $team2 = new VisitorTeam();
        $team2->setClub($manager->getRepository(Club::class)->findOneBy(['name' => 'FCLM Malpassé']))
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($team2);

        $team3 = new VisitorTeam();
        $team3->setClub($manager->getRepository(Club::class)->findOneBy(['name' => 'FC Mazargues']))
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($team3);

        $team4 = new VisitorTeam();
        $team4->setClub($manager->getRepository(Club::class)->findOneBy(['name' => 'Olympique de Marseille']))
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($team4);

        $team5 = new VisitorTeam();
        $team5->setClub($manager->getRepository(Club::class)->findOneBy(['name' => 'AS La Bombardière']))
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($team5);

        $team6 = new VisitorTeam();
        $team6->setClub($manager->getRepository(Club::class)->findOneBy(['name' => 'SO Caillolais']))
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($team6);

        
       
        $manager->flush();
    }
}



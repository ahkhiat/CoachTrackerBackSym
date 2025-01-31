<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\AgeCategory;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use App\Repository\AgeCategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeamFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group2'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $club1 = new Team();
        $club1->setName('U11F1')
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($club1);
    
        $club1 = new Team();
        $club1->setName('U11F2')
                ->setAgeCategory($manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F']));
        $manager->persist($club1);

        

       
        $manager->flush();
    }
}



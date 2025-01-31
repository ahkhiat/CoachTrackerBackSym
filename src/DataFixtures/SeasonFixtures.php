<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group1'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $season = new Season();
        $season->setName('2024/25');
        $manager->persist($season);
       
        $manager->flush();
    }
}



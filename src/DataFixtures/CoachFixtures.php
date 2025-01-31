<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CoachFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group3'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $coach1 = new Coach();
        $coach1->setIsCoachOf($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]));
        $coach1->setUser($manager->getRepository(User::class)->findOneBy(["email" => "fred@gmail.com"]));
        $manager->persist($coach1);

        $coach2 = new Coach();
        $coach2->setIsCoachOf($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]));
        $coach2->setUser($manager->getRepository(User::class)->findOneBy(["email" => "amar@gmail.com"]));
        $manager->persist($coach2);

        $coach3 = new Coach();
        $coach3->setIsCoachOf($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]));
        $coach3->setUser($manager->getRepository(User::class)->findOneBy(["email" => "sonny@gmail.com"]));
        $manager->persist($coach3);

        $coach4 = new Coach();
        $coach4->setIsCoachOf($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]));
        $coach4->setUser($manager->getRepository(User::class)->findOneBy(["email" => "sam@gmail.com"]));
        $manager->persist($coach4);

    
       
        $manager->flush();
    }
    
    
}



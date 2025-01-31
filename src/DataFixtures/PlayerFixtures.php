<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\User;
use App\Entity\Coach;
use App\Entity\Player;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class PlayerFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group3'];
    }
    public function load(ObjectManager $manager): void
    {
    
        // $player1 = new Player();
        // $player1->setPlaysIn($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]));
        // $player1->setUser($manager->getRepository(User::class)->findOneBy(["email" => "lyana@gmail.com"]));
        // $manager->persist($player1);

        

    
       
        $manager->flush();
    }
    
    
}



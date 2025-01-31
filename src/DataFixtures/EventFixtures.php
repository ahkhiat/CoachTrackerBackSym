<?php

namespace App\DataFixtures;

use App\Entity\Club;
use App\Entity\Season;
use App\Entity\Stadium;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Coach;
use App\Entity\Event;
use App\Entity\EventType;
use App\Entity\AgeCategory;
use App\Entity\VisitorTeam;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group4'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $visitorTeam1 = $manager->getRepository(VisitorTeam::class)->findOneBy([
            'club' => $manager->getRepository(Club::class)->findOneBy(['name' => 'ES La Ciotat']),
            'age_category' => $manager->getRepository(AgeCategory::class)->findOneBy(['name' => 'U11F'])
        ]);
        
        $event1 = new Event();
        $event1->setDate(new \DateTime('2025-01-31 08:00:00'))
               ->setEventType($manager->getRepository(EventType::class)->findOneBy(["name" => "Match"]))
               ->setTeam($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]))
               ->setVisitorTeam($visitorTeam1)
               ->setStadium($manager->getRepository(Stadium::class)->findOneBy(["name" => "Stade de la Fourragère"]))
               ->setSeason($manager->getRepository(Season::class)->findOneBy(["name" => "2024/25"]))
               ;
        
        $manager->persist($event1);
        
        $event2 = new Event();
        $event2->setDate(new \DateTime('2025-02-02 18:00:00'))
               ->setEventType($manager->getRepository(EventType::class)->findOneBy(["name" => "Entrainement"]))
               ->setTeam($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]))
               ->setStadium($manager->getRepository(Stadium::class)->findOneBy(["name" => "Stade de la Fourragère"]))
               ->setSeason($manager->getRepository(Season::class)->findOneBy(["name" => "2024/25"]))
               ;
        
        $manager->persist($event2);

        $event3 = new Event();
        $event3->setDate(new \DateTime('2025-02-05 15:30:00'))
               ->setEventType($manager->getRepository(EventType::class)->findOneBy(["name" => "Entrainement"]))
               ->setTeam($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]))
               ->setStadium($manager->getRepository(Stadium::class)->findOneBy(["name" => "Stade de la Fourragère"]))
               ->setSeason($manager->getRepository(Season::class)->findOneBy(["name" => "2024/25"]))
               ;
        
        $manager->persist($event3);



    

    
       
        $manager->flush();
    }
    
    
}



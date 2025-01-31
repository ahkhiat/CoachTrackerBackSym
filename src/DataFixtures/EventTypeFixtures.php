<?php

namespace App\DataFixtures;

use App\Entity\EventType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class EventTypeFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group1'];
    }
    public function load(ObjectManager $manager): void
    {
    
        $eventType1 = new EventType();
        $eventType1->setName('Entrainement');
        $manager->persist($eventType1);

        $eventType1 = new EventType();
        $eventType1->setName('Match');
        $manager->persist($eventType1);

        $eventType1 = new EventType();
        $eventType1->setName('Stage');
        $manager->persist($eventType1);
       
       
        $manager->flush();
    }
}



<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group1'];
    }

    public function load(ObjectManager $manager): void
    {
    
        $roleAdmin = new Role();
        $roleAdmin->setName('ROLE_ADMIN');
        $manager->persist($roleAdmin);

        $roleDirector = new Role();
        $roleDirector->setName('ROLE_DIRECTOR');
        $manager->persist($roleDirector);

        $roleSecretary = new Role();
        $roleSecretary->setName('ROLE_SECRETARY');
        $manager->persist($roleSecretary);

        $roleCoach = new Role();
        $roleCoach->setName('ROLE_COACH');
        $manager->persist($roleCoach);

        $roleParent = new Role();
        $roleParent->setName('ROLE_PARENT');
        $manager->persist($roleParent);

        $rolePlayer = new Role();
        $rolePlayer->setName('ROLE_PLAYER');
        $manager->persist($rolePlayer);

        $roleUser = new Role();
        $roleUser->setName('ROLE_USER');
        $manager->persist($roleUser);

        $manager->flush();
    }
}

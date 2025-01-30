<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rolePlayer = $manager->getRepository(Role::class)->findOneBy(['name' => 'ROLE_PLAYER']);

        $users = [
            ['firstname' => 'Sam', 'lastname' => 'Smith', 'birthdate' => '1998-08-15', 'email' => 'jane.smith@example.com', 'password' => 'password123'],
            ['firstname' => 'Fred', 'lastname' => 'Doe', 'birthdate' => '2000-05-10', 'email' => 'jy.doe@example.com', 'password' => 'password123'],
            ['firstname' => 'Sonny', 'lastname' => 'Doe', 'birthdate' => '2000-05-10', 'email' => 'john.doe@example.com', 'password' => 'password123'],
            ['firstname' => 'Amar', 'lastname' => 'Brown', 'birthdate' => '2003-02-25', 'email' => 'david.brown@example.com', 'password' => 'password123'],
            ['firstname' => 'Lyana', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'l.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Elea', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'e.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Amélia', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'a.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Camilia', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'c.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Nermine', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'n.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Kelya', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'k.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Marie', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'm.johnson@example.com', 'password' => 'password123'],
            ['firstname' => 'Juliette', 'lastname' => 'Johnson', 'birthdate' => '2001-12-30', 'email' => 'j.johnson@example.com', 'password' => 'password123'],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setFirstname($userData['firstname']);
            $user->setLastname($userData['lastname']);
            $user->setBirthdate(new \DateTime($userData['birthdate']));
            $user->setEmail($userData['email']);
            $user->setPassword($userData['password']);
            $user->setRole($rolePlayer);
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}

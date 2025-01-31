<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Player;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group2'];
    }
    public function load(ObjectManager $manager): void
    {
        $rolePlayer = $manager->getRepository(Role::class)->findOneBy(['name' => 'ROLE_PLAYER']);
        $roleCoach = $manager->getRepository(Role::class)->findOneBy(['name' => 'ROLE_COACH']);

        $users = [
            ['firstname' => 'Lyana', 'lastname' => 'Johnson', 'birthdate' => '2014-02-30', 'email' => 'lyana@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Elea', 'lastname' => 'Smith', 'birthdate' => '2014-05-30', 'email' => 'elea@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Amélia', 'lastname' => 'Jordan', 'birthdate' => '2014-03-30', 'email' => 'amelia@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Camilia', 'lastname' => 'Nicholson', 'birthdate' => '2014-12-30', 'email' => 'camilia@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Nermine', 'lastname' => 'Doe', 'birthdate' => '2014-10-30', 'email' => 'nermine@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Kelya', 'lastname' => 'Jackson', 'birthdate' => '2014-07-30', 'email' => 'kelya@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Marie', 'lastname' => 'Lennon', 'birthdate' => '2014-03-30', 'email' => 'marie@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Juliette', 'lastname' => 'Benson', 'birthdate' => '2014-06-02', 'email' => 'juliette@gmail.com', 'password' => 'password123'],
        ];

        $usersCoach = [
            ['firstname' => 'Sam', 'lastname' => 'Hetfield', 'birthdate' => '1983-08-15', 'email' => 'sam@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Fred', 'lastname' => 'Newsted', 'birthdate' => '1985-06-24', 'email' => 'fred@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Sonny', 'lastname' => 'Trujillo', 'birthdate' => '1987-08-03', 'email' => 'sonny@gmail.com', 'password' => 'password123'],
            ['firstname' => 'Amar', 'lastname' => 'Hammet', 'birthdate' => '1992-12-11', 'email' => 'amar@gmail.com', 'password' => 'password123'],
        ];


        foreach ($users as $userData) {
            $user = new User();
            $user->setFirstname($userData['firstname']);
            $user->setLastname($userData['lastname']);
            $user->setBirthdate(new \DateTime($userData['birthdate']));
            $user->setEmail($userData['email']);
            $user->setPassword($userData['password']);
            $user->setRole($rolePlayer);

            $player = new Player();
            $player->setUser($user);
            $player->setPlaysIn($manager->getRepository(Team::class)->findOneBy(["name" => "U11F1"]));
            
            $manager->persist($user);
            $manager->persist($player);
        }

        foreach ($usersCoach as $userData) {
            $user = new User();
            $user->setFirstname($userData['firstname']);
            $user->setLastname($userData['lastname']);
            $user->setBirthdate(new \DateTime($userData['birthdate']));
            $user->setEmail($userData['email']);
            $user->setPassword($userData['password']);
            $user->setRole($roleCoach);
            // $this->addReference('user_'. strtolower($userData['firstname']), $user);
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}

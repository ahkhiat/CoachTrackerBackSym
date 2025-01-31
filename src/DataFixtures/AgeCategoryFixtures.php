<?php

namespace App\DataFixtures;

use App\Entity\AgeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AgeCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group1'];
    }

    public function load(ObjectManager $manager): void
    {
        $categoriesF = ['U8F', 'U9F', 'U10F', 'U11F', 'U12F', 'U13F', 'U14F', 'U15F'];
        $categories = ['U8', 'U9', 'U10', 'U11', 'U12', 'U13', 'U14', 'U15', 'U16', 'U17', 'U18'];
    
        foreach (array_merge($categoriesF, $categories) as $categoryName) {
            $manager->persist((new AgeCategory())->setName($categoryName));
        }
    
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\FoodCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

CONST CATEGORIES = ['VEGETABLES','MEATS','DAIRY','GRAIN','FRUITS','OTHER'];

class FoodCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (CATEGORIES as $CATEGORY){
            $newCategory = new FoodCategory();
            $newCategory->setWording($CATEGORY);
            $manager->persist($newCategory);

            $this->addReference($newCategory->getWording(),$newCategory);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

CONST MEALS = ['MEAL1','MEAL2'];

class MealFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        foreach (MEALS as $key => $MEAL){
            $meal = new Meal();
            $meal->setWording($MEAL);

            foreach (FOODS as $FOOD){
                if(random_int(0,1) === 1){
                    $meal->addFood($this->getReference($FOOD['NAME']));
                }
            }

            $meal->setRecipe($this->getReference(RECIPES[$key]));

            $manager->persist($meal);

            $this->addReference($meal->getWording(),$meal);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
       return [
           RecipeFixtures::class,
           FoodFixtures::class
       ];
    }
}

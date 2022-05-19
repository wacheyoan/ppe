<?php

namespace App\DataFixtures;

use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

CONST MEALS = ['MEAL1','MEAL2','MEAL3','MEAL4','MEAL5','MEAL6','MEAL7','MEAL8','MEAL9','MEAL10'];

class MealFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        foreach (MEALS as $key => $MEAL){
            $meal = new Meal();
            $meal->setWording($MEAL);
            $meal->setPhoto(mb_strtolower($MEAL).'.jpg');

            foreach (FOODS as $FOOD){
                if(random_int(0,2) === 1){
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

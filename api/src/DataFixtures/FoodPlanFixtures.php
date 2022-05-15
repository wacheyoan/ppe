<?php

namespace App\DataFixtures;

use App\Entity\FoodPlan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


CONST FOODPLANS = ['FOODPLAN1'];

class FoodPlanFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (FOODPLANS as $FOODPLAN){
            $foodPlan = new FoodPlan();
            $foodPlan->setWording($FOODPLAN);

            foreach (MEALS as $MEAL){
                $foodPlan->addMeal($this->getReference($MEAL));
            }

            $foodPlan->setPeriod($this->getReference('period0'));

            $manager->persist($foodPlan);

            $this->addReference($foodPlan->getWording(),$foodPlan);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MealFixtures::class,
            PeriodFixtures::class
        ];
    }
}

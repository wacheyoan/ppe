<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

CONST RECIPES = ['RECIPE1','RECIPE2'];

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (RECIPES as $key => $RECIPE){
            $recipe = new Recipe();
            $recipe->setWording($RECIPE);

            $recipe->addUtensil($this->getReference(UTENSILS[$key]));
            $recipe->addStep($this->getReference(STEPS[$key]));

            $manager->persist($recipe);

            $this->addReference($recipe->getWording(),$recipe);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UtensilFixtures::class,
            StepFixtures::class
        ];
    }
}

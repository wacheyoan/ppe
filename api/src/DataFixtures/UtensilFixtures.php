<?php

namespace App\DataFixtures;

use App\Entity\Utensil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

CONST UTENSILS = ['KITCHEN SCALE','WHISK','WOODEN SPOON','OVEN','BOWL','FOOD PROCESSOR','LID','KNIFE','CUTTING BOARD',
    'RAMEKIN','PAN','MICROWAVE','CAKE MOLD','SPATULA','GRATIN DISH'];

class UtensilFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        foreach (UTENSILS as $UTENSIL){
            $utensil = new Utensil();
            $utensil->setWording($UTENSIL);
            $manager->persist($utensil);

            $this->addReference($utensil->getWording(),$utensil);
        }

        $manager->flush();
    }
}

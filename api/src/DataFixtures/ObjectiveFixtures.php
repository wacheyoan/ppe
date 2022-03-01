<?php

namespace App\DataFixtures;

use App\Entity\Objective;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

CONST OBJECTIVES = ['WEIGHT LOSS','WEIGHT GAIN','BULK'];

class ObjectiveFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (OBJECTIVES as $OBJECTIVE){
            $objective = new Objective();
            $objective->setWording($OBJECTIVE);
            $manager->persist($objective);

            $this->addReference($OBJECTIVE,$objective);
        }

        $manager->flush();
    }
}

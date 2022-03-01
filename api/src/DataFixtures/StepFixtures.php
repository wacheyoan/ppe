<?php

namespace App\DataFixtures;

use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

CONST STEPS = ['STEP1','STEP2'];

class StepFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        foreach (STEPS as $STEP){
            $step = new Step();
            $step->setWording($STEP);
            $manager->persist($step);

            $this->addReference($step->getWording(),$step);
        }

        $manager->flush();
    }
}

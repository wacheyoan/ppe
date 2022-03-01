<?php

namespace App\DataFixtures;

use App\Entity\Period;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


CONST PERIODS = [
    [
        'start' =>  '2022-01-01',
        'end'   =>  '2023-01-01'
    ]
];

class PeriodFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (PERIODS as $key => $PERIOD){
            $period = new Period();
            $period->setStart(new \DateTime($PERIOD['start']));
            $period->setEnd(new \DateTime($PERIOD['end']));
            $manager->persist($period);

            $this->addReference('period'.$key,$period);
        }

        $manager->flush();
    }
}

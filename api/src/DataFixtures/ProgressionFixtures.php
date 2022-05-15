<?php

namespace App\DataFixtures;

use App\Entity\Progression;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

CONST PROGRESSIONS = [
    [
        'WEIGHT' => 100.5,
        'date'   => '2022-03-01'
    ],
    [
        'WEIGHT' => 99.4,
        'date'   => '2022-03-02'
    ],
    [
        'WEIGHT' => 97,
        'date'   => '2022-03-05'
    ]
];


class ProgressionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (PROGRESSIONS as $key => $PROGRESSION){
            $progression = new Progression();
            $progression->setWeight($PROGRESSION['WEIGHT']);
            $progression->setDate(new \DateTime($PROGRESSION['date']));
            $manager->persist($progression);

            $this->addReference('progression'.$key,$progression);
        }

        $manager->flush();
    }
}

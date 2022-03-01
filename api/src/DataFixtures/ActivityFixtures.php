<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

CONST ACTIVITIES = [
    [
        'wording' => 'SEDENTARY',
        'coeff'   => 1.2
    ],
    [
        'wording' => 'SLIGHTLY ACTIVE',
        'coeff'   => 1.375
    ],
    [
        'wording' => 'ACTIVE',
        'coeff'   => 1.55
    ],
    [
        'wording' => 'VERY ACTIVE',
        'coeff'   => 1.725
    ],
    [
        'wording' => 'EXTREMELY ACTIVE',
        'coeff'   => 1.9
    ],
];

class ActivityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (ACTIVITIES as $ACTIVITY){
            $activity = new Activity();
            $activity->setWording($ACTIVITY['wording']);
            $activity->setCoefficient($ACTIVITY['coeff']);
            $manager->persist($activity);

            $this->addReference($activity->getWording(),$activity);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

const USERS = [
    [
        'email' => 'admin@gmail.com',
        'roles' => ['ROLE_ADMIN'],
        'pseudo' => 'admin'
    ],
    [
        'email' => 'user1@gmail.com',
        'roles' => ['ROLE_USER'],
        'pseudo' => 'user1'
    ],
    [
        'email' => 'user2@gmail.com',
        'roles' => ['ROLE_USER'],
        'pseudo' => 'user2'
    ]
];

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        foreach (USERS as $key => $USER) {
            $user = new User();
            $user->setRoles($USER['roles']);
            $user->setEmail($USER['email']);
            $user->setHeight(number_format(random_int(13000, 17000) / 100, 2));
            $user->setWeight(number_format(random_int(5000, 20000) / 100, 2));
            $user->setPhone('0123456789');
            $user->setPseudo($USER['pseudo']);
            $user->setFirstName('test');
            $user->setLastName('test');
            $user->setBirthDate(new \DateTime('now'));
            $user->setGender('M');
            $password = $this->hasher->hashPassword($user, '123456');
            $user->setPassword($password);

            $user->setObjective($this->getReference(OBJECTIVES[$key]));
            $user->setActivity($this->getReference(ACTIVITIES[$key]['wording']));

            if ($key === 2) {
                //Means he creates this food on api
                $user->addFood($this->getReference(FOODS[0]['NAME']));
            }

            $user->addFoodPlan($this->getReference(FOODPLANS[0]));

            foreach (PROGRESSIONS as $key2 => $PROGRESSION){
                $user->addProgression($this->getReference('progression'.$key2));
            }


            $manager->persist($user);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ObjectiveFixtures::class,
            ActivityFixtures::class,
            FoodFixtures::class,
            FoodPlanFixtures::class,
            ProgressionFixtures::class
        ];
    }
}

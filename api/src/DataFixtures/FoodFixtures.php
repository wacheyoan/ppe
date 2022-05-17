<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

CONST FOODS = [
    [
        'NAME' => 'APPLE',
        'CATEGORY' => 'FRUITS',
        'CARBS' => 14,
        'SUGAR' => 10,
        'PROTEIN' => 0.3,
        'FAT' => 0.2,
        'SATURATED' => 0,
        'VEGAN' => true
    ],
    [
        'NAME' => 'BANANA',
        'CATEGORY' => 'FRUITS',
        'CARBS' => 23,
        'SUGAR' => 12,
        'PROTEIN' => 1.1,
        'FAT' => 0.3,
        'SATURATED' => 0.1,
        'VEGAN' => true
    ],
    [
        'NAME' => 'GREEN BEANS',
        'CATEGORY' => 'VEGETABLES',
        'CARBS' => 7,
        'SUGAR' => 0,
        'PROTEIN' => 1.8,
        'FAT' => 0.1,
        'SATURATED' => 0,
        'VEGAN' => true
    ],
    [
        'NAME' => 'CARROT',
        'CATEGORY' => 'VEGETABLES',
        'CARBS' => 10,
        'SUGAR' => 4.7,
        'PROTEIN' => 0.9,
        'FAT' => 0.2,
        'SATURATED' => 0,
        'VEGAN' => true
    ],
    [
        'NAME' => 'PEA',
        'CATEGORY' => 'VEGETABLES',
        'CARBS' => 14,
        'SUGAR' => 6,
        'PROTEIN' => 5,
        'FAT' => 0.4,
        'SATURATED' => 0.1,
        'VEGAN' => true
    ],
    [
        'NAME' => 'STEAK',
        'CATEGORY' => 'MEATS',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 25,
        'FAT' => 19,
        'SATURATED' => 8,
        'VEGAN' => true
    ],
    [
        'NAME' => 'CHICKEN',
        'CATEGORY' => 'MEATS',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 20,
        'FAT' => 15,
        'SATURATED' => 5,
        'VEGAN' => false
    ],
    [
        'NAME' => 'PORK',
        'CATEGORY' => 'MEATS',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 20,
        'FAT' => 15,
        'SATURATED' => 5,
        'VEGAN' => false
    ],
    [
        'NAME' => 'FISH',
        'CATEGORY' => 'MEATS',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 20,
        'FAT' => 15,
        'SATURATED' => 5,
        'VEGAN' => false
    ],
    [
        'NAME' => 'EGG',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'YOGHURT',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'CHEESE',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'COOKIE',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'CHOCOLATE',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'COFFEE',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'TEA',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ],
    [
        'NAME' => 'WATER',
        'CATEGORY' => 'OTHER',
        'CARBS' => 0,
        'SUGAR' => 0,
        'PROTEIN' => 5,
        'FAT' => 0,
        'SATURATED' => 0,
        'VEGAN' => false
    ]
];

class FoodFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        foreach (FOODS as $key => $FOOD){
            $food = new Food();
            $food->setWording($FOOD['NAME']);
            $food->setCarbohydrate($FOOD['CARBS']);
            $food->setFat($FOOD['FAT']);
            $food->setProtein($FOOD['PROTEIN']);
            $food->setSaturatedFat($FOOD['SATURATED']);
            $food->setVegan($FOOD['VEGAN']);
            $food->setSugar($FOOD['SUGAR']);
            $manager->persist($food);

            $food->addCategory($this->getReference(CATEGORIES[array_search($FOOD['CATEGORY'], CATEGORIES)]));
            $this->addReference($food->getWording(),$food);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FoodCategoryFixtures::class
        ];
    }
}

<?php

namespace App\Controller;

use App\Entity\FoodPlan;
use App\Repository\MealRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FoodPlanController extends AbstractController
{

    public function generateAction(
        Request $request,
        $id,
        UserRepository $userRepository,
        MealRepository $mealRepository,
        EntityManagerInterface $em
        ): Response
    {
        $data = json_decode($request->getContent(), true);

        if(!($user = $userRepository->find($id))) {
             return new JsonResponse(['error' => 'User not found'], 404);
        }

        $meals = $mealRepository->getMealsByNbMeal($user->getCalories());

        $combinations = [];

        $this->generateCombinations($meals, $combinations, $data['nbMeal'] - 1, 0);

        if($combinations > 0)
        {
            foreach ($user->getFoodPlan() as $foodPlan) {
                $em->remove($foodPlan);
            }
        }

        foreach ($combinations as $combination) {
            $totalCalories = 0;

            foreach ($combination as $meal) {
                $totalCalories += $meal->getCalories();
            }

            if ($totalCalories <= $user->getCalories()) {
                $foodPlan = new FoodPlan();
                $user->addFoodPlan($foodPlan);
                foreach ($combination as $meal) {
                    $foodPlan->addMeal($meal);
                }
                $foodPlan->setWording('Auto generated');
                $em->persist($foodPlan);
            }
        }

        $em->flush();

        return new JsonResponse(['success' => 'Food plan generated'], 200);
    }

    private function generateCombinations(array $meals, array &$combinations, int $int, int $int1)
    {
        if ($int == 0) {
            $combinations[] = $meals;
            return;
        }

        for ($i = $int1, $iMax = count($meals); $i < $iMax; $i++) {
            $newMeals = $meals;
            $newMeals[$i] = $meals[$i];
            $this->generateCombinations($newMeals, $combinations, $int - 1, $i + 1);
        }
    }


}

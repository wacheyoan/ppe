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

        $combinations = $this->perm($meals, $data['nbMeal'] );

        $combinations = array_values(array_map("unserialize", array_unique(array_map("serialize", $combinations))));

        if($combinations > 0)
        {
            foreach ($user->getFoodPlan() as $foodPlan) {
                $em->remove($foodPlan);
                $em->flush();
            }
        }



        foreach ($combinations as $combination) {

            $totalCalories = 0;

            foreach ($combination as &$meal) {
                $meal = $mealRepository->find($meal);
                if($meal) {
                    $totalCalories += $meal->getCalories();
                }
            }
            unset($meal);

            if ($totalCalories <= $user->getCalories() && $totalCalories >= $user->getCalories() - 500) {
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

    private function perm($arr, $n, $result = array())
    {
        if($n <= 0) return false;
        $i = 0;

        $new_result = array();
        foreach($arr as $r) {
            if(count($result) > 0) {
                foreach($result as $res) {
                    $new_element = array_merge($res, array($r));
                    $new_result[] = $new_element;
                }
            } else {
                $new_result[] = array($r);
            }
        }

        if($n == 1) return $new_result;
        return $this->perm($arr, $n - 1, $new_result);
    }




}

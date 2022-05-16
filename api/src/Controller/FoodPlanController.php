<?php

namespace App\Controller;

use App\Repository\MealRepository;
use App\Repository\UserRepository;
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
        MealRepository $mealRepository
        ): Response
    {

        if(!($user = $userRepository->find($id))) {
             return new JsonResponse(['error' => 'User not found'], 404);
        }  

        

        return new JsonResponse(['message' => 'Hello World!']);
    }
}

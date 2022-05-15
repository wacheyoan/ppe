<?php

namespace App\Controller;

use App\Repository\MealRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MealController extends AbstractController
{
    public function likeAction(
        Request $request,
        MealRepository $mealRepository,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): Response
    {

        $body = $request->toArray();
        if(!isset($body['mealId'], $body['userId'])) {
            return new JsonResponse(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }


        $meal = $mealRepository->find($body['mealId']);
        $user = $userRepository->find($body['userId']);

        if($meal && $user)
        {
            $meal->addUserLike($user);
            $entityManager->persist($meal);
            $entityManager->flush();

            return new JsonResponse(['success' => true]);
        }




       return new JsonResponse(['success' => false]);

    }

    public function dislikeAction(
        Request $request,
        MealRepository $mealRepository,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): Response
    {

        $body = $request->toArray();
        if(!isset($body['mealId'], $body['userId'])) {
            return new JsonResponse(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        $meal = $mealRepository->find($body['mealId']);
        $user = $userRepository->find($body['userId']);

        if($meal && $user)
        {
            $meal->addUserDislike($user);
            $entityManager->persist($meal);
            $entityManager->flush();

            return new JsonResponse(['success' => true]);
        }

    }
}

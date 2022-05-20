<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\ObjectiveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    public function registerAction(
        Request $request,
        UserRepository $userRepository,
        ObjectiveRepository $objectiveRepository,
        ActivityRepository $activityRepository,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {

        if($userRepository->findOneBy(['email' => $request->get('username')])) {
            return new JsonResponse(['message' => 'User already exists'], Response::HTTP_BAD_REQUEST);
        }

        if (!($objective = $objectiveRepository->findOneBy(['wording' => $request->get('objective')]))) {
            return new JsonResponse(['message' => 'Objective does not exist'], Response::HTTP_BAD_REQUEST);
        }

        if(!($activity = $activityRepository->findOneBy(['wording' => $request->get('activity')]))) {
            return new JsonResponse(['message' => 'Activity does not exist'], Response::HTTP_BAD_REQUEST);
        }



        $user = new User();
        $user->setEmail($request->get('username'));
        $user->setPassword($request->get('password'));
        $user->setObjective($objective);
        $user->setActivity($activity);
        $user->setFirstName($request->get('firstName'));
        $user->setLastName($request->get('lastName'));
        $user->setBirthDate(new \DateTime($request->get('date')));
        $user->setGender($request->get('sexe'));
        $user->setWeight($request->get('weight'));
        $user->setHeight($request->get('height'));

        $plainPassword = $request->get('password');
        $encoded = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($encoded);

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User created'], Response::HTTP_CREATED);

    }
}

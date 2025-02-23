<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    #[Route('/api/user/profile', name: 'app_user_info', methods:['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function getUserInfo(Security $security): JsonResponse
    {
        $user = $security->getUser();

        $data = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'plays_in' => $user->getPlayer()?->getPlaysIn()?->getName(),
            'is_coach_of' => $user->getCoach()?->getIsCoachOf()?->getName()
        ];
        return $this->json($data);
    }

    // ----------  EN LOCAL  ------------
    // #[Route('/api/user/profile/{userId}', name: 'get_user_info', methods: ['GET'])]
    // public function getUserInfo(int $userId, UserRepository $userRepository): JsonResponse
    // {
    //     $user = $userRepository->find($userId);

    //     if (!$user) {
    //         return new JsonResponse(['error' => 'Utilisateur non trouvé'], 404);
    //     }

    //     $data = [
    //                 'id' => $user->getId(),
    //                 'email' => $user->getEmail(),
    //                 'roles' => $user->getRoles(),
    //                 'plays_in' => $user->getPlayer()?->getPlaysIn()?->getName(),
    //                 'is_coach_of' => $user->getCoach()?->getIsCoachOf()?->getName()
    //             ];
    //             return $this->json($data);
    // }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
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
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'birthdate' => $user->getBirthdate()?->format('Y-m-d'),
            'phone' => $user->getPhone(),
            'roles' => $user->getRoles(),
            'plays_in' => [
                'id' => $user->getPlayer()?->getPlaysIn()?->getId(),
                'name' => $user->getPlayer()?->getPlaysIn()?->getName(),
            ],
            'is_coach_of' => [
                'id' => $user->getCoach()?->getIsCoachOf()?->getId(),
                'name' => $user->getCoach()?->getIsCoachOf()?->getName(),
            ],
            'is_parent_of' => array_map(fn($relation) => [
                'id' => $relation->getChild()->getId(),  
                'firstname' => $relation->getChild()->getFirstname(),
                'lastname' => $relation->getChild()->getLastname(),
                'plays_in' => [
                    'id' => $relation->getChild()->getPlayer()?->getPlaysIn()?->getId(),
                    'name' => $relation->getChild()->getPlayer()?->getPlaysIn()?->getName(),
                ],
            ], $user->getUserIsParentOfs()->toArray()),
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
    #[Route('/api/user/publicprofile', name: 'app_user_public_profile', methods:['GET'])]
    public function getUserPublicProfile(Request $request, UserRepository $userRepository): JsonResponse
    {
        $userId = $request->query->get('user_id');
        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $data = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'birthdate' => $user->getBirthdate()?->format('Y-m-d'),
            'phone' => $user->getPhone(),
            'roles' => $user->getRoles(),
            'plays_in' => [
                'id' => $user->getPlayer()?->getPlaysIn()?->getId(),
                'name' => $user->getPlayer()?->getPlaysIn()?->getName(),
            ],
            'is_coach_of' => [
                'id' => $user->getCoach()?->getIsCoachOf()?->getId(),
                'name' => $user->getCoach()?->getIsCoachOf()?->getName(),
            ],
            'is_parent_of' => array_map(fn($relation) => [
                'id' => $relation->getChild()->getId(),  
                'firstname' => $relation->getChild()->getFirstname(),
                'lastname' => $relation->getChild()->getLastname(),
                'plays_in' => [
                    'id' => $relation->getChild()->getPlayer()?->getPlaysIn()?->getId(),
                    'name' => $relation->getChild()->getPlayer()?->getPlaysIn()?->getName(),
                ],
            ], $user->getUserIsParentOfs()->toArray()),
            'stats' => [
                'convocations' => $user->getPlayer()?->getConvocationsCountForCurrentYear() ?? 0,
                'presences' => $user->getPlayer()?->getPresencesCountForCurrentYear() ?? 0,
                'goals' => $user->getPlayer()?->getGoalsCountForCurrentYear() ?? 0,
            ],  
        ];


        return $this->json($data);
    }
}

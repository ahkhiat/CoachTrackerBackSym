<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\Event;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GoalController extends AbstractController
{
    #[Route('/api/goals/new', name: 'create_goal', methods: ['POST'])]
    public function createGoal(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['eventId'], $data['playerId'], $data['minuteGoal'])) {
            return new JsonResponse(['message' => 'Données invalides'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $event = $entityManager->getRepository(Event::class)->find($data['eventId']);
        $player = $entityManager->getRepository(Player::class)->find($data['playerId']);

        if (!$event || !$player) {
            return new JsonResponse(['message' => 'Événement ou joueur introuvable'], JsonResponse::HTTP_NOT_FOUND);
        }

        $goal = new Goal();
        $goal->setEvent($event);
        $goal->setPlayer($player);
        $goal->setMinuteGoal($data['minuteGoal']);

        $entityManager->persist($goal);
        $entityManager->flush();

        return new JsonResponse(['message' => 'But enregistré avec succès'], JsonResponse::HTTP_CREATED);
    }
}

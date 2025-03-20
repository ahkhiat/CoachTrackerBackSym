<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Player;
use App\Entity\Presence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PresenceController extends AbstractController
{
    
    #[Route('/api/presences/new', methods: ['POST'])]
    public function createPresences(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $event = $em->getRepository(Event::class)->find($data['eventId']);
        if (!$event) {
            return $this->json(['error' => 'Event not found'], Response::HTTP_BAD_REQUEST);
        }

        $presences = [];

        if (!isset($data['playerIds']) || !is_array($data['playerIds'])) {
            return $this->json(['error' => 'Player IDs are required and should be an array'], Response::HTTP_BAD_REQUEST);
        }

        foreach ($data['playerIds'] as $playerId) {
            $player = $em->getRepository(Player::class)->find($playerId);
            if (!$player) {
                return $this->json(['error' => 'Player not found for playerId: ' . $playerId], Response::HTTP_BAD_REQUEST);
            }

            $presence = new Presence();
            $presence->setEvent($event);
            $presence->setPlayer($player);
            $presence->setOnTime(true); // status "pending"

            $errors = $validator->validate($presence);

            if (count($errors) > 0) {
                return new JsonResponse(['error' => $errors[0]->getMessage()], 400);
            }
            $em->persist($presence);
            $presences[] = $presence;
        }
        $em->flush();

        return $this->json([
            'status' => 'Presences created',
            'presences' => count($presences),
        ], Response::HTTP_CREATED);
    }


}

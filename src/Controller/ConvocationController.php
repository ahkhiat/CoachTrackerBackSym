<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Player;
use App\Entity\Convocation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConvocationController extends AbstractController
{
    #[Route('/api/convocations/new', methods: ['POST'])]
    public function createConvocations(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $event = $em->getRepository(Event::class)->find($data['eventId']);
        if (!$event) {
            return $this->json(['error' => 'Event not found'], Response::HTTP_BAD_REQUEST);
        }

        $convocations = [];

        if (!isset($data['playerIds']) || !is_array($data['playerIds'])) {
            return $this->json(['error' => 'Player IDs are required and should be an array'], Response::HTTP_BAD_REQUEST);
        }

        foreach ($data['playerIds'] as $playerId) {
            $player = $em->getRepository(Player::class)->find($playerId);
            if (!$player) {
                return $this->json(['error' => 'Player not found for playerId: ' . $playerId], Response::HTTP_BAD_REQUEST);
            }

            $convocation = new Convocation();
            $convocation->setEvent($event);
            $convocation->setPlayer($player);
            $convocation->setStatus(0); // status "pending"

            // $errors = $validator->validate($convocation);
            // if (count($errors) > 0) {
            //     return $this->json(['error' => (string) $errors], 400);
            // }
            $errors = $validator->validate($convocation);

            if (count($errors) > 0) {
                return new JsonResponse(['error' => $errors[0]->getMessage()], 400);
            }

            $em->persist($convocation);

            $convocations[] = $convocation;
        }

        $em->flush();

        return $this->json([
            'status' => 'Convocations created',
            'convocations' => count($convocations),
        ], Response::HTTP_CREATED);
    }
}

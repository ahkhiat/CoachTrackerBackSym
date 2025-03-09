<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Event;
use App\Entity\Player;
use App\Entity\Season;
use App\Entity\Stadium;
use App\Entity\EventType;
use App\Entity\Convocation;
use App\Entity\VisitorTeam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EventController extends AbstractController
{
   
    #[Route('/api/events/new', methods: ['POST'])]
    public function createEventWithConvocations(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);
    
        $eventType = $em->getRepository(EventType::class)->find($data['eventTypeId']);
        $team = $em->getRepository(Team::class)->find($data['teamId']);
        $visitorTeam = $em->getRepository(VisitorTeam::class)->find($data['visitorTeamId']);
        $stadium = $em->getRepository(Stadium::class)->find($data['stadiumId']);
        $season = $em->getRepository(Season::class)->find($data['seasonId']);
    
        if (!$eventType || !$team || !$visitorTeam || !$stadium || !$season) {
            return $this->json(['error' => 'Invalid data provided'], Response::HTTP_BAD_REQUEST);
        }
    
        $event = new Event();
        $event->setDate(new \DateTime($data['date']));
        $event->setEventType($eventType);
        $event->setTeam($team);
        $event->setVisitorTeam($visitorTeam);
        $event->setStadium($stadium);
        $event->setSeason($season);
    
        $em->persist($event);
    
        // foreach ($data['convocations'] as $convocationData) {
        //     $convocation = new Convocation();
        //     $player = $em->getRepository(Player::class)->find($convocationData['playerId']);
        //     if (!$player) {
        //         return $this->json(['error' => 'Player not found'], Response::HTTP_BAD_REQUEST);
        //     }
        //     $convocation->setEvent($event);
        //     $convocation->setPlayer($player);
        //     $convocation->setStatus($convocationData['status']);
    
        //     $em->persist($convocation);
        // }

        $em->flush();
        return $this->json(['status' => 'Event created'], Response::HTTP_CREATED);
    }
    

}

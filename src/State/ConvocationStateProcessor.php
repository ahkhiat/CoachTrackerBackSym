<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Convocation;
use App\Repository\EventRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ConvocationStateProcessor implements ProcessorInterface
{
    private EntityManagerInterface $entityManager;
    private EventRepository $eventRepository;
    private PlayerRepository $playerRepository;

    public function __construct(
        EntityManagerInterface $entityManager, 
        EventRepository $eventRepository,
        PlayerRepository $playerRepository
    ) {
        $this->entityManager = $entityManager;
        $this->eventRepository = $eventRepository;
        $this->playerRepository = $playerRepository;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if (!$data instanceof Convocation) {
            throw new BadRequestException("Données invalides.");
        }

        // Récupérer l'événement lié à la convocation
        $eventId = $data->getEvent()->getId();
        $event = $this->eventRepository->find($eventId);

        if (!$event) {
            throw new BadRequestException("Événement ID {$eventId} introuvable.");
        }

        // Vérifier et récupérer les joueurs existants
        $validPlayers = [];
        foreach ($data->getPlayers() as $player) {
            $existingPlayer = $this->playerRepository->find($player->getId());

            if (!$existingPlayer) {
                throw new BadRequestException("Joueur ID {$player->getId()} introuvable.");
            }

            $validPlayers[] = $existingPlayer;
        }

        // Associer l'événement et les joueurs validés à la convocation
        $data->setEvent($event);
        $data->setPlayers($validPlayers);

        // Sauvegarde en base
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}

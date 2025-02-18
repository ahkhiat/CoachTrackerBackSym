<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Dto\RegisterDto;
use App\Form\RegisterUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class RegisterController extends AbstractController
{
   
    public function __construct(
        private EntityManagerInterface $entityManager, 
        UserPasswordHasherInterface $passwordHasher, 
        ValidatorInterface $validator,
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->validator = $validator;
    }

    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User;

        $form = $this->createForm(RegisterUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $entityManager->getRepository(Role::class)->findOneBy(['name' => 'ROLE_USER']);
            if (!$role) {
                throw new \Exception('Le rôle ROLE_USER est introuvable dans la base de données.');
            }
            $user->setRole($role);
            
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('register/index.html.twig', [
            'registerForm' => $form->createView()
        ]);
    }

    #[Route('/api/register', name: 'api_register')]
    public function register(Request $request, 
                            UserPasswordHasherInterface $passwordHasher, 
                            ValidatorInterface $validator,
                            JWTTokenManagerInterface $jwtManager,
                            EntityManagerInterface $manager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $registerDto = new RegisterDto();
        $registerDto->password = $data['password'];
        $registerDto->email = $data['email'];
        $registerDto->firstname = $data['firstname'];
        $registerDto->lastname = $data['lastname'];

        if (!empty($data['birthdate'])) {
            $registerDto->birthdate = new \DateTime($data['birthdate']);
        }

        $violations = $validator->validate($registerDto);
        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }
    
            return $this->json([
                'errors' => $errors
            ], 400);
        }

        $existingUser = $manager->getRepository(User::class)
                                ->findOneBy(['email' => $registerDto->email]);
        if ($existingUser) {
            return $this->json(['error' => 'L\'email est déjà utilisé.'], 400);
    }

        $user = new User();
        $user->setEmail($registerDto->email);
        $user->setFirstname($registerDto->firstname);
        $user->setLastname($registerDto->lastname);
        $user->setBirthdate($registerDto->birthdate);
        $user->setRole($manager->getRepository(Role::class)->findOneBy(['name' => 'ROLE_USER']));

        $hashedPassword = $passwordHasher->hashPassword($user, $registerDto->password);
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $token = $jwtManager->create($user);

        return $this->json([
            'token' => $token
        ], 201);
    }

}

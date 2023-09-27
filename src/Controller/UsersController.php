<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        // $user = new User();
        // $user->setName("labas");
        // $user->setFirstname("justine");
        // $user->setAge(28);

        // $em->persist($user);
        // $em->flush();

        $user2 = new User();
        $form = $this->createForm(UserType::class, $user2);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user2);
            $em->flush();
        }

        $this->addFlash('success', 'La personne a été ajouté avec succès.');

        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
            'form' => $form,
        ]);
    }
}

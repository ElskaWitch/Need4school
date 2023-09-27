<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Horse;
use App\Form\HorseType;

class HorsesController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/horses', name: 'app_horses')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $horseRepo = $em->getRepository(Horse::class);
        $findHorse = $horseRepo->findAll();

        $horse2 = new Horse();
        $form = $this->createForm(HorseType::class,$horse2);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        $em->persist($horse2);
        $em->flush();
        }

        $this->addFlash('success', 'Le cheval a été ajouté avec succès.');

        return $this->render('horses/index.html.twig', [
            'allHorses' => $findHorse,
            'form' => $form,
        ]);
    }

    #[Route('/horse/{id}', name: 'horse_details')]
    public function show(Horse $horse): Response
    {
        return $this->render('horses/details.html.twig', [
            'horse' => $horse,
        ]);
    }
}



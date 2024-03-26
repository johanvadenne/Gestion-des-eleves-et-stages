<?php

namespace App\Controller;

use App\Entity\StageApprentissage;
use App\Form\StageApprentissageType;
use App\Repository\StageApprentissageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/stage/apprentissage')]
class StageApprentissageController extends AbstractController
{
    #[Route('/', name: 'app_stage_apprentissage_index', methods: ['GET'])]
    public function index(StageApprentissageRepository $stageApprentissageRepository): Response
    {
        return $this->render('stage_apprentissage/index.html.twig', [
            'stage_apprentissages' => $stageApprentissageRepository->findAllWithRelations(),
        ]);
    }

    #[Route('/new', name: 'app_stage_apprentissage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stageApprentissage = new StageApprentissage();
        $form = $this->createForm(StageApprentissageType::class, $stageApprentissage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stageApprentissage);
            $entityManager->flush();

            return $this->redirectToRoute('app_stage_apprentissage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stage_apprentissage/new.html.twig', [
            'stage_apprentissage' => $stageApprentissage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stage_apprentissage_show', methods: ['GET'])]
    public function show(StageApprentissage $stageApprentissage): Response
    {
        return $this->render('stage_apprentissage/show.html.twig', [
            'stage_apprentissage' => $stageApprentissage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_stage_apprentissage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StageApprentissage $stageApprentissage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StageApprentissageType::class, $stageApprentissage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_stage_apprentissage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stage_apprentissage/edit.html.twig', [
            'stage_apprentissage' => $stageApprentissage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stage_apprentissage_delete', methods: ['POST'])]
    public function delete(Request $request, StageApprentissage $stageApprentissage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stageApprentissage->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($stageApprentissage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_stage_apprentissage_index', [], Response::HTTP_SEE_OTHER);
    }
}

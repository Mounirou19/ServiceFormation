<?php

// src/Controller/User/AppelFondsController.php
namespace App\Controller\User;

use App\Entity\AppelFonds;
use App\Repository\AppelFondsRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/appel-fonds')]
class AppelFondsController extends AbstractController
{
    #[Route('/', name: 'user_appel_fonds_index')]
    public function index(AppelFondsRepository $appelDeFondsRepository): Response
    {
        $appelsDeFonds = $appelDeFondsRepository->findAll();
        return $this->render('user/appel_fonds/index.html.twig', [
            'appels_de_fonds' => $appelsDeFonds,
        ]);
    }

    #[Route('/new', name: 'user_appel_fonds_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll(); // Récupérer tous les projets

        if ($request->isMethod('POST')) {
            $appelDeFonds = new AppelFonds();
            $appelDeFonds->setMontant($request->request->get('amount'));
            $appelDeFonds->setDateAppel(new \DateTime($request->request->get('date')));
            $projectId = $request->request->get('project');
            $project = $projectRepository->find($projectId);

            if ($project) {
                $appelDeFonds->setProject($project);
            }

            $entityManager->persist($appelDeFonds);
            $entityManager->flush();

            return $this->redirectToRoute('user_appel_fonds_index');
        }

        return $this->render('user/appel_fonds/new.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/edit/{id}', name: 'user_appel_fonds_edit', methods: ['GET', 'POST'])]
    public function edit(AppelFonds $appelDeFonds, Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        if ($request->isMethod('POST')) {
            $appelDeFonds->setMontant($request->request->get('amount'));
            $appelDeFonds->setDateAppel(new \DateTime($request->request->get('date')));
            $projectId = $request->request->get('project');
            $project = $projectRepository->find($projectId);

            if ($project) {
                $appelDeFonds->setProject($project);
            }

            $entityManager->flush();

            return $this->redirectToRoute('user_appel_fonds_index');
        }

        return $this->render('user/appel_fonds/edit.html.twig', [
            'appel_fonds' => $appelDeFonds,
            'projects' => $projects,
        ]);
    }

    #[Route('/delete/{id}', name: 'user_appel_fonds_delete', methods: ['POST'])]
    public function delete(AppelFonds $appelDeFonds, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($appelDeFonds);
        $entityManager->flush();

        return $this->redirectToRoute('user_appel_fonds_index');
    }
}

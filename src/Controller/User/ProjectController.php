<?php
// src/Controller/User/ProjectController.php
namespace App\Controller\User;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ClientRepository;

#[Route('/user/projects')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'user_project_index')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        return $this->render('user/project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/new', name: 'user_project_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll(); // Récupérer tous les clients
        $clients = array_map(function ($client) {
            return [
                'id' => $client->getId(),
                'siren' => $client->getSiren(),
                'iban' => $client->getIban(),
                'adresse' => $client->getAdresse(),
                'contact_facturation' => $client->getContactFacturation(),
                'commission' => $client->getCommission(),
            ];
        }, $clients);

        if ($request->isMethod('POST')) {
            $project = new Project();
            $project->setName($request->request->get('name'));
            $project->setBudgetInitial($request->request->get('budget_initial'));
            $project->setSeuilAlerte($request->request->get('seuil_alerte'));
            $project->setListeDiffusion(explode(',', $request->request->get('liste_diffusion')));
            $clientId = $request->request->get('client');
            $client = $clientRepository->find($clientId);

            if ($client) {
                $project->setClient($client);
            }

            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('user_project_index');
        }

        return $this->render('user/project/new.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/edit/{id}', name: 'user_project_edit', methods: ['GET', 'POST'])]
    public function edit(Project $project, Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll(); // Récupérer tous les clients

        if ($request->isMethod('POST')) {
            $project->setName($request->request->get('name'));
            $project->setBudgetInitial($request->request->get('budget_initial'));
            $project->setSeuilAlerte($request->request->get('seuil_alerte'));
            $project->setListeDiffusion(explode(',', $request->request->get('liste_diffusion')));
            $clientId = $request->request->get('client');
            $client = $clientRepository->find($clientId);

            if ($client) {
                $project->setClient($client);
            }

            $entityManager->flush();

            return $this->redirectToRoute('user_project_index');
        }

        return $this->render('user/project/edit.html.twig', [
            'project' => $project,
            'clients' => $clients,
        ]);
    }

    #[Route('/delete/{id}', name: 'user_project_delete', methods: ['POST'])]
    public function delete(Project $project, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($project);
        $entityManager->flush();

        return $this->redirectToRoute('user_project_index');
    }
}

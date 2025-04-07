<?php
// src/Controller/User/SessionController.php
namespace App\Controller\User;

use App\Entity\Session;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user/sessions')]
class SessionController extends AbstractController
{
    #[Route('/', name: 'user_session_index')]
    public function index(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();
        return $this->render('user/session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/new', name: 'user_session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        if ($request->isMethod('POST')) {
            $session = new Session();
            $session->setName($request->request->get('name'));
            $session->setDateDebut(new \DateTime($request->request->get('date_debut')));
            $session->setDateFin(new \DateTime($request->request->get('date_fin')));
            
            $formationId = $request->request->get('formation');
            $formation = $formationRepository->find($formationId);

            if ($formation) {
                $session->setFormation($formation);
            }

            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('user_session_index');
        }

        return $this->render('user/session/new.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/edit/{id}', name: 'user_session_edit', methods: ['GET', 'POST'])]
    public function edit(Session $session, Request $request, EntityManagerInterface $entityManager, FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        if ($request->isMethod('POST')) {
            $session->setName($request->request->get('name'));
            $session->setDateDebut(new \DateTime($request->request->get('date_debut')));
            $session->setDateFin(new \DateTime($request->request->get('date_fin')));
            
            $formationId = $request->request->get('formation');
            $formation = $formationRepository->find($formationId);

            if ($formation) {
                $session->setFormation($formation);
            }

            $entityManager->flush();

            return $this->redirectToRoute('user_session_index');
        }

        return $this->render('user/session/edit.html.twig', [
            'session' => $session,
            'formations' => $formations,
        ]);
    }

    #[Route('/delete/{id}', name: 'user_session_delete', methods: ['POST'])]
    public function delete(Session $session, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('user_session_index');
    }
}
<?php
// src/Controller/User/FormationController.php
namespace App\Controller\User;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user/formations')]
class FormationController extends AbstractController
{
    #[Route('/', name: 'user_formation_index')]
    public function index(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();
        return $this->render('user/formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/new', name: 'user_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $formation = new Formation();
            $formation->setName($request->request->get('name'));
            $formation->setDescription($request->request->get('description'));
            $formation->setDuree($request->request->get('duree'));

            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('user_formation_index');
        }

        return $this->render('user/formation/new.html.twig');
    }

    #[Route('/edit/{id}', name: 'user_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Formation $formation, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $formation->setName($request->request->get('name'));
            $formation->setDescription($request->request->get('description'));
            $formation->setDuree($request->request->get('duree'));

            $entityManager->flush();

            return $this->redirectToRoute('user_formation_index');
        }

        return $this->render('user/formation/edit.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/delete/{id}', name: 'user_formation_delete', methods: ['POST'])]
    public function delete(Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($formation);
        $entityManager->flush();

        return $this->redirectToRoute('user_formation_index');
    }
}

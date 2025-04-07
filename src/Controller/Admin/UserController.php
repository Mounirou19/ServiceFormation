<?php
// src/Controller/Admin/UserController.php
namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/users')]
class UserController extends AbstractController
{
    // Afficher la liste des utilisateurs
    #[Route('/', name: 'admin_user_index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    // Créer un nouvel utilisateur
    #[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Si le formulaire est soumis
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setEmail($request->request->get('email'));
            $user->setRoles([$request->request->get('role')]);
            $user->setPassword($passwordHasher->hashPassword($user, $request->request->get('password')));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/new.html.twig');
    }

    // Modifier un utilisateur existant
    #[Route('/edit/{id}', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $user->setEmail($request->request->get('email'));
            $user->setRoles([$request->request->get('role')]);
            if ($request->request->get('password')) {
                $user->setPassword($passwordHasher->hashPassword($user, $request->request->get('password')));
            }

            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user
        ]);
    }

    // Supprimer un utilisateur
    #[Route('/delete/{id}', name: 'admin_user_delete', methods: ['GET'])]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_user_index');
    }
}

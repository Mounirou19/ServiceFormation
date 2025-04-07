<?php
// src/Controller/User/ClientController.php
namespace App\Controller\User;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user/clients')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'user_client_index')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();
        return $this->render('user/client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/new', name: 'user_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $client = new Client();
            $client->setSiren($request->request->get('siren'));
            $client->setIban($request->request->get('iban'));
            $client->setAdresse($request->request->get('adresse'));
            $client->setContactFacturation($request->request->get('contact_facturation'));
            $client->setCommission($request->request->get('commission'));

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('user_client_index');
        }

        return $this->render('user/client/new.html.twig');
    }

    #[Route('/edit/{id}', name: 'user_client_edit', methods: ['GET', 'POST'])]
    public function edit(Client $client, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $client->setSiren($request->request->get('siren'));
            $client->setIban($request->request->get('iban'));
            $client->setAdresse($request->request->get('adresse'));
            $client->setContactFacturation($request->request->get('contact_facturation'));
            $client->setCommission($request->request->get('commission'));

            $entityManager->flush();

            return $this->redirectToRoute('user_client_index');
        }

        return $this->render('user/client/edit.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/delete/{id}', name: 'user_client_delete', methods: ['POST'])]
    public function delete(Client $client, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($client);
        $entityManager->flush();

        return $this->redirectToRoute('user_client_index');
    }
}

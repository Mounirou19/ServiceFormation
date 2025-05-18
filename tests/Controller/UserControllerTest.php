<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/users/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des utilisateurs');
    }

    public function testNewUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/users/new');

        $form = $crawler->selectButton('Créer')->form([
            'email' => 'newuser@example.com',
            'role' => 'ROLE_USER',
            'password' => 'password',
        ]);

        $client->submit($form);
        $this->assertResponseRedirects('/admin/users/');
    }
}

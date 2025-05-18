<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserEntity(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('password');

        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles());
        $this->assertEquals('password', $user->getPassword());
    }
}

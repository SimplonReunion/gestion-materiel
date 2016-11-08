<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GestionControllerTest extends WebTestCase
{
    public function testManage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Manage');
    }

    public function testListusers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list/users');
    }

}

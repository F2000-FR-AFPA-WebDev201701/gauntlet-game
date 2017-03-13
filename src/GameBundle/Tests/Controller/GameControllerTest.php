<?php

namespace GameBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create');
    }

    public function testJoin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'join/{id}');
    }

    public function testRefresh()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'refresh/{id}');
    }

    public function testPlay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/play/{id}/{action}');
    }

}

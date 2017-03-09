<?php

namespace GameBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MapControllerTest extends WebTestCase
{
    public function testInitmap()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/initmap');
    }

}

<?php

namespace OC\PlatformBundle\Tests\PlatformBundle\Advert\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdvertTest extends WebTestCase
{
    public function testIndex()
    {
//        $client = static::createClient();

//        $crawler = $client->request('GET', '/hello/Fabien');
// $crawler->filter('html:contains("Hello Fabien")')->count()
        $this->assertEquals(42, 42);
    }
}

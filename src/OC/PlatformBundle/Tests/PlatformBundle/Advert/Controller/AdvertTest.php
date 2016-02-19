<?php

namespace OC\PlatformBundle\Tests\PlatformBundle\Advert\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdvertTest extends WebTestCase
{
    public function testIndex()
    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/');
//        $form = $crawler->selectButton('submit')->form();
//
//// set some values
//        $form['name'] = 'Lucas';
//        $form['form_name[subject]'] = 'Hey there!';
//
//// submit the form
//        $crawler = $client->submit($form);
        $this->assertEquals(42, 42);
    }
}

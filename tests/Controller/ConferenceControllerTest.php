<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }
    
    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(3, $crawler->filter('h4'));

        $client->clickLink('View');

        $this->assertPageTitleContains('Chisinau');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Chisinau 2021');
        $this->assertSelectorExists('div:contains("There are 6 comments")');
    }
}
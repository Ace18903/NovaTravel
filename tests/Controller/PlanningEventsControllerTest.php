<?php

namespace App\Tests\Controller;

use App\Entity\PlanningEvents;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PlanningEventsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $planningEventRepository;
    private string $path = '/planning/events/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->planningEventRepository = $this->manager->getRepository(PlanningEvents::class);

        foreach ($this->planningEventRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PlanningEvent index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'planning_event[id_planning]' => 'Testing',
            'planning_event[id_event]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->planningEventRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new PlanningEvents();
        $fixture->setId_planning('My Title');
        $fixture->setId_event('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PlanningEvent');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new PlanningEvents();
        $fixture->setId_planning('Value');
        $fixture->setId_event('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'planning_event[id_planning]' => 'Something New',
            'planning_event[id_event]' => 'Something New',
        ]);

        self::assertResponseRedirects('/planning/events/');

        $fixture = $this->planningEventRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_planning());
        self::assertSame('Something New', $fixture[0]->getId_event());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new PlanningEvents();
        $fixture->setId_planning('Value');
        $fixture->setId_event('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/planning/events/');
        self::assertSame(0, $this->planningEventRepository->count([]));
    }
}

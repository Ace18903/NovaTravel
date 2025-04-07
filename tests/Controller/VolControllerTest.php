<?php

namespace App\Tests\Controller;

use App\Entity\Vol;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class VolControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $volRepository;
    private string $path = '/vol/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->volRepository = $this->manager->getRepository(Vol::class);

        foreach ($this->volRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vol index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'vol[id]' => 'Testing',
            'vol[compagnie]' => 'Testing',
            'vol[aeroport_depart]' => 'Testing',
            'vol[aeroport_arrivee]' => 'Testing',
            'vol[date_depart]' => 'Testing',
            'vol[date_arrivee]' => 'Testing',
            'vol[prix]' => 'Testing',
            'vol[destination]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->volRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vol();
        $fixture->setId('My Title');
        $fixture->setCompagnie('My Title');
        $fixture->setAeroport_depart('My Title');
        $fixture->setAeroport_arrivee('My Title');
        $fixture->setDate_depart('My Title');
        $fixture->setDate_arrivee('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDestination('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vol');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vol();
        $fixture->setId('Value');
        $fixture->setCompagnie('Value');
        $fixture->setAeroport_depart('Value');
        $fixture->setAeroport_arrivee('Value');
        $fixture->setDate_depart('Value');
        $fixture->setDate_arrivee('Value');
        $fixture->setPrix('Value');
        $fixture->setDestination('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vol[id]' => 'Something New',
            'vol[compagnie]' => 'Something New',
            'vol[aeroport_depart]' => 'Something New',
            'vol[aeroport_arrivee]' => 'Something New',
            'vol[date_depart]' => 'Something New',
            'vol[date_arrivee]' => 'Something New',
            'vol[prix]' => 'Something New',
            'vol[destination]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vol/');

        $fixture = $this->volRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getCompagnie());
        self::assertSame('Something New', $fixture[0]->getAeroport_depart());
        self::assertSame('Something New', $fixture[0]->getAeroport_arrivee());
        self::assertSame('Something New', $fixture[0]->getDate_depart());
        self::assertSame('Something New', $fixture[0]->getDate_arrivee());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getDestination());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vol();
        $fixture->setId('Value');
        $fixture->setCompagnie('Value');
        $fixture->setAeroport_depart('Value');
        $fixture->setAeroport_arrivee('Value');
        $fixture->setDate_depart('Value');
        $fixture->setDate_arrivee('Value');
        $fixture->setPrix('Value');
        $fixture->setDestination('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/vol/');
        self::assertSame(0, $this->volRepository->count([]));
    }
}

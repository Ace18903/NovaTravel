<?php

namespace App\Tests\Controller;

use App\Entity\ReservationHebergement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReservationHebergementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $reservationHebergementRepository;
    private string $path = '/reservation/hebergement/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->reservationHebergementRepository = $this->manager->getRepository(ReservationHebergement::class);

        foreach ($this->reservationHebergementRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReservationHebergement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation_hebergement[id]' => 'Testing',
            'reservation_hebergement[date_debut]' => 'Testing',
            'reservation_hebergement[date_fin]' => 'Testing',
            'reservation_hebergement[nb_perso]' => 'Testing',
            'reservation_hebergement[id_user]' => 'Testing',
            'reservation_hebergement[id_hebergement]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->reservationHebergementRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationHebergement();
        $fixture->setId('My Title');
        $fixture->setDate_debut('My Title');
        $fixture->setDate_fin('My Title');
        $fixture->setNb_perso('My Title');
        $fixture->setId_user('My Title');
        $fixture->setId_hebergement('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReservationHebergement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationHebergement();
        $fixture->setId('Value');
        $fixture->setDate_debut('Value');
        $fixture->setDate_fin('Value');
        $fixture->setNb_perso('Value');
        $fixture->setId_user('Value');
        $fixture->setId_hebergement('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation_hebergement[id]' => 'Something New',
            'reservation_hebergement[date_debut]' => 'Something New',
            'reservation_hebergement[date_fin]' => 'Something New',
            'reservation_hebergement[nb_perso]' => 'Something New',
            'reservation_hebergement[id_user]' => 'Something New',
            'reservation_hebergement[id_hebergement]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservation/hebergement/');

        $fixture = $this->reservationHebergementRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getDate_debut());
        self::assertSame('Something New', $fixture[0]->getDate_fin());
        self::assertSame('Something New', $fixture[0]->getNb_perso());
        self::assertSame('Something New', $fixture[0]->getId_user());
        self::assertSame('Something New', $fixture[0]->getId_hebergement());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationHebergement();
        $fixture->setId('Value');
        $fixture->setDate_debut('Value');
        $fixture->setDate_fin('Value');
        $fixture->setNb_perso('Value');
        $fixture->setId_user('Value');
        $fixture->setId_hebergement('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reservation/hebergement/');
        self::assertSame(0, $this->reservationHebergementRepository->count([]));
    }
}

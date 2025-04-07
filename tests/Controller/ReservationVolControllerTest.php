<?php

namespace App\Tests\Controller;

use App\Entity\ReservationVol;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReservationVolControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $reservationVolRepository;
    private string $path = '/reservation/vol/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->reservationVolRepository = $this->manager->getRepository(ReservationVol::class);

        foreach ($this->reservationVolRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReservationVol index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation_vol[id]' => 'Testing',
            'reservation_vol[classe]' => 'Testing',
            'reservation_vol[nb_billets]' => 'Testing',
            'reservation_vol[id_user]' => 'Testing',
            'reservation_vol[id_vol]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->reservationVolRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationVol();
        $fixture->setId('My Title');
        $fixture->setClasse('My Title');
        $fixture->setNb_billets('My Title');
        $fixture->setId_user('My Title');
        $fixture->setId_vol('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReservationVol');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationVol();
        $fixture->setId('Value');
        $fixture->setClasse('Value');
        $fixture->setNb_billets('Value');
        $fixture->setId_user('Value');
        $fixture->setId_vol('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation_vol[id]' => 'Something New',
            'reservation_vol[classe]' => 'Something New',
            'reservation_vol[nb_billets]' => 'Something New',
            'reservation_vol[id_user]' => 'Something New',
            'reservation_vol[id_vol]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservation/vol');

        $fixture = $this->reservationVolRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getClasse());
        self::assertSame('Something New', $fixture[0]->getNb_billets());
        self::assertSame('Something New', $fixture[0]->getId_user());
        self::assertSame('Something New', $fixture[0]->getId_vol());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationVol();
        $fixture->setId('Value');
        $fixture->setClasse('Value');
        $fixture->setNb_billets('Value');
        $fixture->setId_user('Value');
        $fixture->setId_vol('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reservation/vol');
        self::assertSame(0, $this->reservationVolRepository->count([]));
    }
}

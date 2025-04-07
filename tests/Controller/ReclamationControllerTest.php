<?php

namespace App\Tests\Controller;

use App\Entity\Reclamation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReclamationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $reclamationRepository;
    private string $path = '/reclamation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->reclamationRepository = $this->manager->getRepository(Reclamation::class);

        foreach ($this->reclamationRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reclamation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reclamation[id]' => 'Testing',
            'reclamation[date_reclamation]' => 'Testing',
            'reclamation[type]' => 'Testing',
            'reclamation[message]' => 'Testing',
            'reclamation[id_user]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->reclamationRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reclamation();
        $fixture->setId('My Title');
        $fixture->setDate_reclamation('My Title');
        $fixture->setType('My Title');
        $fixture->setMessage('My Title');
        $fixture->setId_user('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reclamation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reclamation();
        $fixture->setId('Value');
        $fixture->setDate_reclamation('Value');
        $fixture->setType('Value');
        $fixture->setMessage('Value');
        $fixture->setId_user('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reclamation[id]' => 'Something New',
            'reclamation[date_reclamation]' => 'Something New',
            'reclamation[type]' => 'Something New',
            'reclamation[message]' => 'Something New',
            'reclamation[id_user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reclamation/');

        $fixture = $this->reclamationRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getDate_reclamation());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getMessage());
        self::assertSame('Something New', $fixture[0]->getId_user());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reclamation();
        $fixture->setId('Value');
        $fixture->setDate_reclamation('Value');
        $fixture->setType('Value');
        $fixture->setMessage('Value');
        $fixture->setId_user('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reclamation/');
        self::assertSame(0, $this->reclamationRepository->count([]));
    }
}

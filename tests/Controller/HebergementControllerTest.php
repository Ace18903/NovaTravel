<?php

namespace App\Tests\Controller;

use App\Entity\Hebergement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HebergementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $hebergementRepository;
    private string $path = '/hebergement/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->hebergementRepository = $this->manager->getRepository(Hebergement::class);

        foreach ($this->hebergementRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Hebergement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'hebergement[id]' => 'Testing',
            'hebergement[type]' => 'Testing',
            'hebergement[nom]' => 'Testing',
            'hebergement[adresse]' => 'Testing',
            'hebergement[description]' => 'Testing',
            'hebergement[prix_nuit]' => 'Testing',
            'hebergement[photo]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->hebergementRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Hebergement();
        $fixture->setId('My Title');
        $fixture->setType('My Title');
        $fixture->setNom('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrix_nuit('My Title');
        $fixture->setPhoto('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Hebergement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Hebergement();
        $fixture->setId('Value');
        $fixture->setType('Value');
        $fixture->setNom('Value');
        $fixture->setAdresse('Value');
        $fixture->setDescription('Value');
        $fixture->setPrix_nuit('Value');
        $fixture->setPhoto('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'hebergement[id]' => 'Something New',
            'hebergement[type]' => 'Something New',
            'hebergement[nom]' => 'Something New',
            'hebergement[adresse]' => 'Something New',
            'hebergement[description]' => 'Something New',
            'hebergement[prix_nuit]' => 'Something New',
            'hebergement[photo]' => 'Something New',
        ]);

        self::assertResponseRedirects('/hebergement/');

        $fixture = $this->hebergementRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getPrix_nuit());
        self::assertSame('Something New', $fixture[0]->getPhoto());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Hebergement();
        $fixture->setId('Value');
        $fixture->setType('Value');
        $fixture->setNom('Value');
        $fixture->setAdresse('Value');
        $fixture->setDescription('Value');
        $fixture->setPrix_nuit('Value');
        $fixture->setPhoto('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/hebergement/');
        self::assertSame(0, $this->hebergementRepository->count([]));
    }
}

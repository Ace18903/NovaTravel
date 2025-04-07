<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $userRepository;
    private string $path = '/user/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->userRepository = $this->manager->getRepository(User::class);

        foreach ($this->userRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'user[id]' => 'Testing',
            'user[nom]' => 'Testing',
            'user[prenom]' => 'Testing',
            'user[cin]' => 'Testing',
            'user[tel]' => 'Testing',
            'user[role]' => 'Testing',
            'user[mail]' => 'Testing',
            'user[password]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->userRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setId('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setCin('My Title');
        $fixture->setTel('My Title');
        $fixture->setRole('My Title');
        $fixture->setMail('My Title');
        $fixture->setPassword('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setId('Value');
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setCin('Value');
        $fixture->setTel('Value');
        $fixture->setRole('Value');
        $fixture->setMail('Value');
        $fixture->setPassword('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user[id]' => 'Something New',
            'user[nom]' => 'Something New',
            'user[prenom]' => 'Something New',
            'user[cin]' => 'Something New',
            'user[tel]' => 'Something New',
            'user[role]' => 'Something New',
            'user[mail]' => 'Something New',
            'user[password]' => 'Something New',
        ]);

        self::assertResponseRedirects('/user/');

        $fixture = $this->userRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getId());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getCin());
        self::assertSame('Something New', $fixture[0]->getTel());
        self::assertSame('Something New', $fixture[0]->getRole());
        self::assertSame('Something New', $fixture[0]->getMail());
        self::assertSame('Something New', $fixture[0]->getPassword());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setId('Value');
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setCin('Value');
        $fixture->setTel('Value');
        $fixture->setRole('Value');
        $fixture->setMail('Value');
        $fixture->setPassword('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/user/');
        self::assertSame(0, $this->userRepository->count([]));
    }
}

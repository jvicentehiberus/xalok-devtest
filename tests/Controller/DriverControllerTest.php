<?php

namespace App\Test\Controller;

use App\Entity\Driver;
use App\Repository\DriverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DriverControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private DriverRepository $repository;
    private string $path = '/driver/';
    private EntityManagerInterface $manager;

    public static function setUpBeforeClass(): void
    {
        exec('php /var/www/html/bin/console doctrine:database:drop --force --env=test --no-interaction');
        exec('php /var/www/html/bin/console doctrine:database:create --env=test --no-interaction');
        exec('php /var/www/html/bin/console doctrine:migrations:migrate --env=test --no-interaction');
    }

    public static function tearDownAfterClass(): void
    {
        exec('php /var/www/html/bin/console doctrine:database:drop --force --env=test --no-interaction');
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Driver::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Driver index');
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'driver[Uuid]' => 'Testing',
            'driver[Name]' => 'Testing',
            'driver[Surname]' => 'Testing',
            'driver[License]' => 'Testing',
        ]);

        self::assertResponseRedirects('/driver/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Driver();
        $fixture->setUuid('My Title');
        $fixture->setName('My Title');
        $fixture->setSurname('My Title');
        $fixture->setLicense('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Driver');
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Driver();
        $fixture->setUuid('My Title');
        $fixture->setName('My Title');
        $fixture->setSurname('My Title');
        $fixture->setLicense('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'driver[Uuid]' => 'Something New',
            'driver[Name]' => 'Something New',
            'driver[Surname]' => 'Something New',
            'driver[License]' => 'Something New',
        ]);

        self::assertResponseRedirects('/driver/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUuid());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getSurname());
        self::assertSame('Something New', $fixture[0]->getLicense());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Driver();
        $fixture->setUuid('My Title');
        $fixture->setName('My Title');
        $fixture->setSurname('My Title');
        $fixture->setLicense('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/driver/');
    }
}

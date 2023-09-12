<?php

namespace App\Test\Controller;

use App\Entity\Trip;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TripRepository $repository;
    private string $path = '/trip/';
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
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Trip::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Trip index');
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'trip[Date]' => 'Testing',
            'trip[Vehicle]' => 'Testing',
            'trip[Driver]' => 'Testing',
        ]);

        self::assertResponseRedirects('/trip/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        // TODO
    }

    public function testEdit(): void
    {
        // TODO
    }

    public function testRemove(): void
    {
        // TODO
    }
}

<?php

namespace App\Test\Controller;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VehicleControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private VehicleRepository $repository;
    private string $path = '/vehicle/';
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
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Vehicle::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vehicle index');
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'vehicle[Uuid]' => 'Testing',
            'vehicle[Brand]' => 'Testing',
            'vehicle[Model]' => 'Testing',
            'vehicle[Plate]' => 'Testing',
            'vehicle[LicenseRequired]' => 'Testing',
        ]);

        self::assertResponseRedirects('/vehicle/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vehicle();
        $fixture->setUuid('My Title');
        $fixture->setBrand('My Title');
        $fixture->setModel('My Title');
        $fixture->setPlate('My Title');
        $fixture->setLicenseRequired('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vehicle');
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vehicle();
        $fixture->setUuid('My Title');
        $fixture->setBrand('My Title');
        $fixture->setModel('My Title');
        $fixture->setPlate('My Title');
        $fixture->setLicenseRequired('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vehicle[Uuid]' => 'Something New',
            'vehicle[Brand]' => 'Something New',
            'vehicle[Model]' => 'Something New',
            'vehicle[Plate]' => 'Something New',
            'vehicle[LicenseRequired]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vehicle/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUuid());
        self::assertSame('Something New', $fixture[0]->getBrand());
        self::assertSame('Something New', $fixture[0]->getModel());
        self::assertSame('Something New', $fixture[0]->getPlate());
        self::assertSame('Something New', $fixture[0]->getLicenseRequired());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Vehicle();
        $fixture->setUuid('My Title');
        $fixture->setBrand('My Title');
        $fixture->setModel('My Title');
        $fixture->setPlate('My Title');
        $fixture->setLicenseRequired('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/vehicle/');
    }
}

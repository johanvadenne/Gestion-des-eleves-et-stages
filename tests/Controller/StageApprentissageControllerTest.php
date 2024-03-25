<?php

namespace App\Test\Controller;

use App\Entity\StageApprentissage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StageApprentissageControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/stage/apprentissage/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(StageApprentissage::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StageApprentissage index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'stage_apprentissage[DateDebut]' => 'Testing',
            'stage_apprentissage[DateFin]' => 'Testing',
            'stage_apprentissage[IdEtudiant]' => 'Testing',
            'stage_apprentissage[IdEntreprise]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new StageApprentissage();
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setIdEtudiant('My Title');
        $fixture->setIdEntreprise('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StageApprentissage');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new StageApprentissage();
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setIdEtudiant('Value');
        $fixture->setIdEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'stage_apprentissage[DateDebut]' => 'Something New',
            'stage_apprentissage[DateFin]' => 'Something New',
            'stage_apprentissage[IdEtudiant]' => 'Something New',
            'stage_apprentissage[IdEntreprise]' => 'Something New',
        ]);

        self::assertResponseRedirects('/stage/apprentissage/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateDebut());
        self::assertSame('Something New', $fixture[0]->getDateFin());
        self::assertSame('Something New', $fixture[0]->getIdEtudiant());
        self::assertSame('Something New', $fixture[0]->getIdEntreprise());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new StageApprentissage();
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setIdEtudiant('Value');
        $fixture->setIdEntreprise('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/stage/apprentissage/');
        self::assertSame(0, $this->repository->count([]));
    }
}

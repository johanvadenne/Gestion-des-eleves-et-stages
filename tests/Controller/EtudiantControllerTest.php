<?php

namespace App\Test\Controller;

use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EtudiantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/etudiant/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Etudiant::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Etudiant index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'etudiant[NomEleve]' => 'Testing',
            'etudiant[PrenomEtudiant]' => 'Testing',
            'etudiant[IdEtude]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Etudiant();
        $fixture->setNomEleve('My Title');
        $fixture->setPrenomEtudiant('My Title');
        $fixture->setIdEtude('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Etudiant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Etudiant();
        $fixture->setNomEleve('Value');
        $fixture->setPrenomEtudiant('Value');
        $fixture->setIdEtude('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'etudiant[NomEleve]' => 'Something New',
            'etudiant[PrenomEtudiant]' => 'Something New',
            'etudiant[IdEtude]' => 'Something New',
        ]);

        self::assertResponseRedirects('/etudiant/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomEleve());
        self::assertSame('Something New', $fixture[0]->getPrenomEtudiant());
        self::assertSame('Something New', $fixture[0]->getIdEtude());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Etudiant();
        $fixture->setNomEleve('Value');
        $fixture->setPrenomEtudiant('Value');
        $fixture->setIdEtude('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/etudiant/');
        self::assertSame(0, $this->repository->count([]));
    }
}

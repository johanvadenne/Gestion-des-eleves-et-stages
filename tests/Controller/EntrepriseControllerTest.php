<?php

namespace App\Test\Controller;

use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntrepriseControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/entreprise/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Entreprise::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entreprise index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'entreprise[NomEntreprise]' => 'Testing',
            'entreprise[Mail]' => 'Testing',
            'entreprise[Adresse]' => 'Testing',
            'entreprise[Ville]' => 'Testing',
            'entreprise[SiteWeb]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entreprise();
        $fixture->setNomEntreprise('My Title');
        $fixture->setMail('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setVille('My Title');
        $fixture->setSiteWeb('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entreprise');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entreprise();
        $fixture->setNomEntreprise('Value');
        $fixture->setMail('Value');
        $fixture->setAdresse('Value');
        $fixture->setVille('Value');
        $fixture->setSiteWeb('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'entreprise[NomEntreprise]' => 'Something New',
            'entreprise[Mail]' => 'Something New',
            'entreprise[Adresse]' => 'Something New',
            'entreprise[Ville]' => 'Something New',
            'entreprise[SiteWeb]' => 'Something New',
        ]);

        self::assertResponseRedirects('/entreprise/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomEntreprise());
        self::assertSame('Something New', $fixture[0]->getMail());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getSiteWeb());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entreprise();
        $fixture->setNomEntreprise('Value');
        $fixture->setMail('Value');
        $fixture->setAdresse('Value');
        $fixture->setVille('Value');
        $fixture->setSiteWeb('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/entreprise/');
        self::assertSame(0, $this->repository->count([]));
    }
}

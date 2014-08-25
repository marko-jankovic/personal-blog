<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 8/25/14
 * Time: 12:06 AM
 */

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Tags extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface, ContainerAwareInterface
{

    private $container;

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 19;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setName('Symfony 2');
        $tag1->setQuantifier(3);

        $tag2 = new Tag();
        $tag2->setName('Tutorial');
        $tag2->setQuantifier(1);

        $tag3 = new Tag();
        $tag3->setName('PHP');
        $tag3->setQuantifier(6);

        $tag4 = new Tag();
        $tag4->setName('Doctrine 2');
        $tag4->setQuantifier(2);

        $tag5 = new Tag();
        $tag5->setName('Twig');
        $tag5->setQuantifier(10);

        $tag6 = new Tag();
        $tag6->setName('Assetic');
        $tag6->setQuantifier(5);

        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->persist($tag3);
        $manager->persist($tag4);
        $manager->persist($tag5);
        $manager->persist($tag6);
        $manager->flush();

        $this->addReference('tag1', $tag1);
        $this->addReference('tag2', $tag2);
        $this->addReference('tag3', $tag3);
        $this->addReference('tag4', $tag4);
        $this->addReference('tag5', $tag5);
        $this->addReference('tag6', $tag6);
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 6:43 PM
 */

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures for the Author Entity
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdococ}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdococ}
     */
    public function load(ObjectManager $manager)
    {
        $a1 = new Author();
        $a1->setName('Mare Author1');

        $a2 = new Author();
        $a2->setName('Mare Author2');

        $manager->persist($a1);
        $manager->persist($a2);

        $manager->flush();
    }
} 
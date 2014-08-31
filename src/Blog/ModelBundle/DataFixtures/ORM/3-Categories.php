<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 5/11/14
 * Time: 6:51 PM
 */

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Category Entity
 */
class Categories extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdococ}
     */
    public function getOrder()  
    {
        return 20;
    }

    /**
     * {@inheritdococ}
     */
    public function load(ObjectManager $manager)
    {

        $c1 = new Category();
        $c1->setName('prva kategorija');
        $c1->setDescription('something something description 1');

        $c2 = new Category();
        $c2->setName('druga kategorija');
        $c2->setDescription('something something description 2');

        $c3 = new Category();
        $c3->setName('treca kategorija');
        $c3->setDescription('something something description 3');

        $manager->persist($c1);
        $manager->persist($c2);
        $manager->persist($c3);

        $manager->flush();
    }
    
}
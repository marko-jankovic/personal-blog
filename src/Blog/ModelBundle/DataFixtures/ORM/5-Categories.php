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
        $c1->setDescription('something something description');

        $manager->persist($c1);
        $manager->flush();
    }
    
}
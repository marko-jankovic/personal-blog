<?php
/**
 * Created by PhpStorm.
 * User: markojankovic
 * Date: 5/11/14
 * Time: 6:51 PM
 */

namespace Blog\AdminBundle\DataFixtures\ORM;

use Blog\AdminBundle\Entity\Author;
use Blog\AdminBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Post Entity
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface{


    /**
     * {@inheritdococ}
     */
    public function getOrder()
    {
        return 15;
    }

    /**
     * {@inheritdococ}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Maretov prvi post');
        $p1->setBody('The most obvious answer has to be "the cloud". Historically, distributed systems and software/platform as a service have existed since before 2005');
        $p1->setAuthor($this->getAuthor($manager, 'Mare Author1'));

        $p2 = new Post();
        $p2->setTitle('Maretov drugi post');
        $p2->setBody("went to either the first or second Carsonified Future of Web Apps/Design conferences -- I think it was back in 2005, so over seven years ago now. I've been thinking a lot about that time and the things that used to preoccupy me:");
        $p2->setAuthor($this->getAuthor($manager, 'Mare Author2'));

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->flush();
    }

    /**
     * Get the author
     *
     * @param ObjectManager $manager
     * @param string        $name
     *
     * @return Author
     */
    private function getAuthor(ObjectManager $manager, $name)
    {
        return $manager->getRepository("BlogAdminBundle:Author")->findOneBy(
            array(
                'name' => $name
            )
        );
    }
} 
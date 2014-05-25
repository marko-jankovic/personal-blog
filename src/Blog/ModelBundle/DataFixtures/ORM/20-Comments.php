<?php
/**
 * User: markojankovic
 * Date: 5/12/14
 * Time: 12:58 AM
 */
namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Comment Entity
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('BlogModelBundle:Post')->findAll();

        $comments = array(
            0 => 'Mauris posuere adipiscing sapien eu ultricies. Nunc a dignissim dolor. Duis porttitor faucibus nulla, eu
faucibus nibh venenatis eu. Donec nec nibh a nibh convallis fringilla eget sed leo. Sed tempor lobortis enim,
porta posuere lacus semper in.',
            1 => 'Cras elementum condimentum ligula ac ullamcorper. Duis fringilla at nibh et vulputate. Quisque euismod
vehicula ante, a ornare dolor volutpat ac. Duis felis odio, mollis vitae convallis interdum, accumsan vitae tellus.',
            2 => 'Nunc et tortor a magna faucibus tempor. In eros sem, tristique dignissim ultricies et, facilisis a massa.
Vivamus vitae mauris id neque semper adipiscing. Vivamus nibh ipsum, consectetur a nisi et, congue accumsan
mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        );

        $i = 0;

        foreach ($posts as $post) {

            $comment1 = new Comment();
            $comment1->setAuthorName('Someone1');
            $comment1->setBody($comments[0]);
            $comment1->setPost($post);

            $comment2 = new Comment();
            $comment2->setAuthorName('Someone2');
            $comment2->setBody($comments[1]);
            $comment2->setPost($post);

            $comment3 = new Comment();
            $comment3->setAuthorName('Someone3');
            $comment3->setBody($comments[2]);
            $comment3->setPost($post);

            $manager->persist($comment1);
            $manager->persist($comment2);
            $manager->persist($comment3);
        }

        $manager->flush();
    }
}
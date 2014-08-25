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
        return 25;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();

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
            $comment1->setUser($post->getUser());
            $comment1->setApproved(true);

            $answer = new Comment();
            $answer->setAuthorName('Someone put reply');
            $answer->setBody($comments[0]);
            $answer->setPost($post);
            $answer->setUser($post->getUser());
            $answer->setApproved(true);

            $answer->setOrigin($comment1);

            $answer2 = new Comment();
            $answer2->setAuthorName('Someone replay to reply');
            $answer2->setBody($comments[0]);
            $answer2->setPost($post);
            $answer2->setUser($post->getUser());
            $answer2->setApproved(true);

            $answer2->setOrigin($answer);

            $comment2 = new Comment();
            $comment2->setAuthorName('Someone2');
            $comment2->setBody($comments[1]);
            $comment2->setPost($post);
            $comment2->setUser($post->getUser());
            $comment2->setApproved(true);

            $comment3 = new Comment();
            $comment3->setAuthorName('Someone3');
            $comment3->setBody($comments[2]);
            $comment3->setUser($post->getUser());
            $comment3->setPost($post);
            $comment3->setApproved(true);

            $manager->persist($comment1);
            $manager->persist($comment2);
            $manager->persist($comment3);
            $manager->persist($answer);
            $manager->persist($answer2);
        }

        $manager->flush();
    }
}
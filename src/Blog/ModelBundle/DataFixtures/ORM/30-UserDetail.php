<?php
/**
 * User: markojankovic
 * Date: 6/8/14
 * Time: 8:42 PM
 */

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\UserDetails;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class UserDetail extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface, ContainerAwareInterface
{

    private $container;

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 30;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userDetails = new UserDetails();

        $userDetails->setFullName('Marko Jankovic');
        $userDetails->setLocation('Belgrade');
        $userDetails->setLinkedin('http://rs.linkedin.com/in/markojankovic');
        $userDetails->setGithub('https://github.com/Marko-Jankovic');
        $userDetails->setCompany('Vast.com');
        $userDetails->setTwitter('https://twitter.com/markmaremi');

        $userDetails->setUser($this->getUser($manager, 'admin@example.com'));

        $manager->persist($userDetails);
        $manager->flush();
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

    /**
     * Get the user
     *
     * @param ObjectManager $manager
     * @param string        $email
     *
     * @return User
     */
    private function getUser(ObjectManager $manager, $email)
    {
        return $manager->getRepository("ModelBundle:User")->findOneBy(
                       array(
                           'email' => $email
                       )
        );
    }
}
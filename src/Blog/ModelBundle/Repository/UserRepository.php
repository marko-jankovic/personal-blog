<?php

namespace Blog\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository implements UserProviderInterface
{

    public function findOneByUsernameOrEmail($username)
    {

        return $this->createQueryBuilder('u')
                    ->andWhere('u.username = :username OR u.email = :email')
                    ->setParameter('username', $username)
                    ->setParameter('email', $username)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    /**
     * Overwrited loadUserByUsername from UserProvider
     *
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $user = $this->findOneByUsernameOrEmail($username);

        if (!$user) {
            throw new UsernameNotFoundException('No user with ' .$username. ' username/email found!');
        }

        return $user;
    }

    /**
     * Overwrited refreshUser from UserProvider
     *
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);

        if(!is_null($user->getId())) {

            if (!$this->supportsClass($class)) {
                throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported!', $class));
            }

            return $this->find($user->getId());
        }
    }

    /**
     * returns entity class Blog\ModelBundle\Entity\User
     *
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }
}

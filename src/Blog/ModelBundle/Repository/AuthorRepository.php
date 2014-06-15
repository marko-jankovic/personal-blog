<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 11:38 PM
 */

namespace Blog\ModelBundle\Repository;

use Blog\ModelBundle\Entity\Author;
use Doctrine\ORM\EntityRepository;

class AuthorRepository extends EntityRepository{

    /**
     * Find the first author
     *
     * @return Author
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
                   ->orderBy('a.id', 'asc')
                   ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('BlogModelBundle:Author')
                 ->createQueryBuilder('a');

        return $qb;
    }
} 
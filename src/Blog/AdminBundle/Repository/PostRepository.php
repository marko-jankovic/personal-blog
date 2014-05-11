<?php
/**
 * User: markojankovic
 * Date: 5/11/14
 * Time: 9:56 PM
 */

namespace Blog\AdminBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    /**
     * Find Latest
     *
     * @param int $num
     *
     * @return array
     */
    public function findLatest($num)
    {
        $qb = $this->getQueryBuilder()
                ->orderBy('p.createdAt', 'desc')
                ->setMaxResults($num);

        return $qb->getQuery()->getResult();
    }

    /**
     * Find the first post
     *
     * @return Post
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
                   ->orderBy('p.id', 'asc')
                   ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('BlogAdminBundle:Post')
                ->createQueryBuilder('p');

        return $qb;
    }
} 
<?php

namespace AppBundle\Repository;

/**
 * PostRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function fetchByTag($tag)
    {
        return $this->createQueryBuilder('p')
            ->where('p.tags LIKE :tag')
            ->setParameter('tag', "%$tag%")
            ->orderBy('p.published', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function fetch()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.published', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BuildingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BuildingRepository extends EntityRepository
{
    public function count($query, $sorting, $page, $pagesize)
    {
        $count = true;
        $count = $this->findByWithPagin($query, $sorting, $page, $pagesize, $count);
        return $count;
    }

    public function findByWithPagin($query, $sorting, $page, $pagesize, $count = false)
    {
        $em = $this->getEntityManager();
        $qb = $this->createQueryBuilder('b');

        if ($count)
        {
            $qb->select('count(b.id)');
        }

        if ($query) {
             $qb->where(
                $qb->expr()->orX(
                    $qb->expr()->like('b.id', ':query'),
                    $qb->expr()->like('b.name', ':query'),
                    $qb->expr()->like('b.price', ':query'),
                    $qb->expr()->like('b.width', ':query'),
                    $qb->expr()->like('b.height', ':query')
                )
            )->setParameter('query','%'.$query.'%');
        }

        if ($sorting)
        {
            foreach ((array)$sorting as $key => $value ) 
            {
                $qb->orderBy('b.'.$key, $value);
            }
        }
        if (!$count)
        {
            $qb->setFirstResult(($page - 1) * $pagesize)
                ->setMaxResults($pagesize);
            $result = $qb->getQuery()->getResult();
        } else 
        {
            $result = $qb->getQuery()->getSingleScalarResult();
        }
        return $result;
    }
}

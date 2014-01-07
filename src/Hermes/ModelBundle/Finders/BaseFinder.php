<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/7/14
 * Time: 5:57 AM
 */

namespace Hermes\ModelBundle\Finders;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Hermes\ModelBundle\Entities\BaseEntity;

/**
 * Base Class for all finders
 *
 * @author Jakub Kohout <jakub@eastbiz.com>
 */
abstract class BaseFinder
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var \Doctrine\ORM\EntityRepository|NULL
     */
    private $repository = NULL;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
    abstract function getEntityName();

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Use getEntityManager instead
     *
     * @deprecated
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getManager()
    {
        return $this->entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository()
    {
        if ($this->repository === NULL) {
            $this->repository = $this->entityManager->getRepository($this->getEntityName());
        }

        return $this->repository;
    }

    /**
     * @return BaseEntity[]
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param $id integer
     * @return BaseEntity
     */
    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return BaseEntity[]
     */
    public function findBy($criteria, $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param array $criteria
     * @param array $orderBy
     * @return BaseEntity
     */
    public function findOneBy($criteria, $orderBy = null)
    {
        return $this->getRepository()->findOneBy($criteria, $orderBy);
    }

    /**
     * @param null|string $alias
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilder($alias = NULL)
    {
        if ($alias !== null) {
            return $this->getRepository()->createQueryBuilder($alias);
        } else {
            return $this->getEntityManager()->createQueryBuilder();
        }
    }

    /**
     * @param string $sql
     * @param \Doctrine\ORM\Query\ResultSetMapping $rsm
     * @return \Doctrine\ORM\NativeQuery
     */
    public function createNativeQuery($sql, ResultSetMapping $rsm)
    {
        return $this->getEntityManager()->createNativeQuery($sql, $rsm);
    }

    /**
     * @param array $ids
     * @return BaseEntity[]
     */
    public function findByIds($ids)
    {
        $qb = $this->createQueryBuilder('e');
        $qb
            ->where($qb->expr()->in('e.id', ':ids'))
            ->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }

}
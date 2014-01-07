<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/7/14
 * Time: 5:55 AM
 */

namespace Hermes\ModelBundle\Facades;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;

/**
 * Class BaseFacade
 * @author Jakub Kohout <jakub@eastbiz.com>
 * @author Filip Prochazka <filip@prochazka.su>
 */
abstract class BaseFacade {
    const FLUSH = TRUE;
    const NO_FLUSH = FALSE;

    /**
     * @var EntityManager
     */
    protected $manager;

    public function __construct(EntityManager $em)
    {
        $this->manager = $em;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->manager;
    }


    /**
     * Persists given entities and flushes all to the storage.
     *
     * @param object|array|\Doctrine\Common\Collections\Collection $entity
     * @return object|array
     */
    public function save($entity = NULL)
    {
        if ($entity !== NULL) {
            $result = $this->add($entity);
            $this->flush();

            return $result;
        }

        $this->flush();
        return array();
    }


    /**
     * Persists given entities, but does not flush.
     *
     * @param object|array|\Doctrine\Common\Collections\Collection $entity
     * @return object|array
     */
    public function add($entity)
    {
        if (is_array($entity) || $entity instanceof \Traversable || $entity instanceof Collection) {
            foreach ($entity as $item) {
                $this->add($item);
            }

        }
        $this->getEntityManager()->persist($entity);

        return $entity;
    }

    public function flush(){
        $this->getEntityManager()->flush();
    }




    /**
     * @param object|array|\Doctrine\Common\Collections\Collection $entity
     * @param bool $flush
     * @throws InvalidArgumentException
     */
    public function delete($entity, $flush = self::FLUSH)
    {
        if (is_array($entity) || $entity instanceof \Traversable || $entity instanceof Collection) {
            foreach ($entity as $item) {
                $this->delete($item, self::NO_FLUSH);
            }

            $this->flush($flush);

            return;

        }
        $this->getEntityManager()->remove($entity);
        $this->flush($flush);
    }



}
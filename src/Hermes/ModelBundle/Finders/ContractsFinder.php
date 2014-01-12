<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/12/14
 * Time: 10:00 AM
 */

namespace Hermes\ModelBundle\Finders;


class ContractsFinder extends BaseFinder{

    /**
     * @return string
     */
    function getEntityName()
    {
        return "Hermes\\ModelBundle\\Entity\\Contract";
    }


    /**
     * Get all Contracts grouped by Branches and add totalPrice and totalCount
     * @param \DateTime $begin
     * @param \DateTime $end
     * @return array
     */
    public function findAllGroupedByBranch(\DateTime $begin, \DateTime $end) {
        return $this->createQueryBuilder('c')
                    ->addSelect('o.name as name, SUM(c.price) as totalPrice, COUNT(c.id) as totalCount')
                    ->join('c.office', 'o')
                    ->groupBy('c.office')
                    ->where('c.signed > :begin AND c.signed < :end')
                    ->setParameter('begin', $begin)
                    ->setParameter('end', $end)
                    ->orderBy('totalCount', 'desc')
                    ->getQuery()
                    ->getResult();
    }


    /**
     * @param \DateTime $begin
     * @param \DateTime $end
     * @param $min minimal price of contract
     * @param $max maximal price of contract
     * @return array
     */
    public function findByPriceRangeGroupedByBranch(\DateTime $begin, \DateTime $end, $min, $max){
        return $this->createQueryBuilder('c')
            ->addSelect('o.name as name, SUM(c.price) as totalPrice, COUNT(c.id) as totalCount')
            ->join('c.office', 'o')
            ->groupBy('c.office')
            ->where('c.signed > :begin AND c.signed < :end AND c.price > :min AND c.price < :max')
            ->setParameter('begin', $begin)
            ->setParameter('end', $end)
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('totalCount', 'desc')
            ->getQuery()
            ->getResult();
    }




} 
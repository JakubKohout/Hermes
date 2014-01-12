<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/12/14
 * Time: 9:06 PM
 */

namespace Hermes\ModelBundle\Finders;


class CountriesFinder extends BaseFinder{
    /**
     * @return string
     */
    function getEntityName()
    {
        return "Hermes\\ModelBundle\\Entity\\Country";
    }



    public function findAllWithSales(\DateTime $begin, \DateTime $end) {

        return $this->createQueryBuilder()
            ->select('c.name, COUNT(con) totalCount, SUM(con.price) totalPrice, COUNT(t) as tripsCount')
            ->from($this->getEntityName(), 'c')
            ->leftJoin('c.trips', 't')
            ->leftJoin('t.contracts', 'con')
            ->groupBy('c')
            ->orderBy('totalCount', 'desc')
            ->getQuery()
            ->getResult();
    }
} 
<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/12/14
 * Time: 9:43 AM
 */

namespace Hermes\ModelBundle\Finders;

use Hermes\ModelBundle\Entity\Office;

class BranchesFinder extends BaseFinder{


    /**
     * @return string
     */
    public function getEntityName()
    {
        return "Hermes\\ModelBundle\\Entity\\Office";
    }


    public function findAllWithContractsAmount($begin, $end){
        
    }


} 
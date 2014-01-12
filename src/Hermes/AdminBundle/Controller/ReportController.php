<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/12/14
 * Time: 5:47 AM
 */

namespace Hermes\AdminBundle\Controller;


use Hermes\ModelBundle\Finders\ContractsFinder;
use Hermes\ModelBundle\Finders\CountriesFinder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation\Inject;


class ReportController extends Controller{

    /**
     * @var ContractsFinder
     * @Inject("hermes.model.finders.contracts")
     */
    private $contractsFinder;

    /**
     * @var CountriesFinder
     * @Inject("hermes.model.finders.countries")
     */
    private $countriesFinder;


    public function indexAction(){
        return $this->render('HermesAdminBundle:Report:index.html.twig');
    }



    public function branchesByAmountOfSalesAction($beginDate = null, $endDate = null){

        $beginDate = \DateTime::createFromFormat('d/m/Y',$beginDate);
        $endDate = \DateTime::createFromFormat('d/m/Y',$endDate);

        $branches = $this->contractsFinder->findAllGroupedByBranch($beginDate, $endDate);
        return $this->render('HermesAdminBundle:Report:branchesByAmountOfSales.html.twig', array('branches' => $branches, 'beginDate' => $beginDate, 'endDate' => $endDate));
    }


    public function branchesByPriceRangesAction($beginDate = null, $endDate = null){
        $beginDate = \DateTime::createFromFormat('d/m/Y',$beginDate);
        $endDate = \DateTime::createFromFormat('d/m/Y',$endDate);

        $ranges = [
            ['min' => 0, 'max' => 9999],
            ['min' => 10000, 'max' => 24999],
            ['min' => 25000, 'max' => 49999],
            ['min' => 50000, 'max' => 199999]
        ];

        foreach($ranges as &$range){
            $range['branches'] = $this->contractsFinder->findByPriceRangeGroupedByBranch($beginDate, $endDate, $range['min'], $range['max']);
        }

        return $this->render('HermesAdminBundle:Report:branchesInPriceCategories.html.twig', array(
            'ranges' => $ranges
        ));
    }


    public function mostPopularCountriesAction($beginDate = null, $endDate = null){
        $beginDate = \DateTime::createFromFormat('d/m/Y',$beginDate);
        $endDate = \DateTime::createFromFormat('d/m/Y',$endDate);

        $countries = $this->countriesFinder->findAllWithSales($beginDate, $endDate);

        #\Doctrine\Common\Util\Debug::dump($countries);

        return $this->render('HermesAdminBundle:Report:mostPopularCountries.html.twig', array(
            'countries' => $countries
        ));
    }


} 
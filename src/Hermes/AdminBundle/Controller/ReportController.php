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
use Symfony\Component\HttpFoundation\Request;


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


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function branchesByAmountOfSalesAction(Request $request){
        list($beginDate, $endDate) = $this->parseDateTime($request);

        $branches = $this->contractsFinder->findAllGroupedByBranch($beginDate, $endDate);
        return $this->render('HermesAdminBundle:Report:branchesByAmountOfSales.html.twig', array('branches' => $branches, 'beginDate' => $beginDate, 'endDate' => $endDate));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function branchesByPriceRangesAction(Request $request){
        list($beginDate, $endDate) = $this->parseDateTime($request);

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
            'ranges' => $ranges,
            'beginDate' => $beginDate,
            'endDate' => $endDate
        ));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostPopularCountriesAction(Request $request){
        list($beginDate, $endDate) = $this->parseDateTime($request);

        $countries = $this->countriesFinder->findAllWithSales($beginDate, $endDate);

        return $this->render('HermesAdminBundle:Report:mostPopularCountries.html.twig', array(
            'countries' => $countries,
            'beginDate' => $beginDate,
            'endDate' => $endDate
        ));
    }


    /**
     * @param Request $request
     * @return array
     */
    private function parseDateTime(Request $request){
        if(empty($request->query->get('beginDate'))){
            $beginDate = \DateTime::createFromFormat('d/m/Y', '01/01/2013');
        }else{
            $beginDate = \DateTime::createFromFormat('d/m/Y', $request->query->get('beginDate'));
        }

        if(empty($request->query->get('endDate'))){
            $endDate = \DateTime::createFromFormat('d/m/Y', '31/12/2013');
        }else{
            $endDate = \DateTime::createFromFormat('d/m/Y', $request->query->get('endDate'));
        }

        return [$beginDate, $endDate];
    }


} 
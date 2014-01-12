<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/12/14
 * Time: 5:47 AM
 */

namespace Hermes\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller{

    public function indexAction(){
        return $this->render('HermesAdminBundle:Report:index.html.twig');
    }



    public function branchesByAmountOfSalesAction($beginDate = null, $endDate = null){
        return $this->render('HermesAdminBundle:Report:branchesByAmountOfSales.html.twig');
    }


} 
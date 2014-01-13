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
     * @param string $format
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function branchesByAmountOfSalesAction(Request $request, $format = '.html'){
        list($beginDate, $endDate) = $this->parseDateTime($request);

        $branches = $this->contractsFinder->findAllGroupedByBranch($beginDate, $endDate);

        if($format == ".xls"){
            return $this->generateBranchesDocument(array(
                'branches' => $branches,
                'beginDate' => $beginDate,
                'endDate' => $endDate
            ));
        }


        return $this->render('HermesAdminBundle:Report:branchesByAmountOfSales.html.twig', array('branches' => $branches, 'beginDate' => $beginDate, 'endDate' => $endDate));
    }


    /**
     * @param Request $request
     * @param string $format
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function branchesByPriceRangesAction(Request $request, $format = '.html'){
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

        if($format == ".xls"){
            return $this->generateBranchesInRangesDocument(array(
                'ranges' => $ranges,
                'beginDate' => $beginDate,
                'endDate' => $endDate
            ));
        }

        return $this->render('HermesAdminBundle:Report:branchesInPriceCategories.html.twig', array(
            'ranges' => $ranges,
            'beginDate' => $beginDate,
            'endDate' => $endDate
        ));
    }


    /**
     * @param Request $request
     * @param string $format
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function mostPopularCountriesAction(Request $request, $format = ".html"){
        list($beginDate, $endDate) = $this->parseDateTime($request);

        $countries = $this->countriesFinder->findAllWithSales($beginDate, $endDate);

        if($format == ".xls"){
            return $this->generateMostPopularCountriesDocument(array(
                'countries' => $countries,
                'beginDate' => $beginDate,
                'endDate' => $endDate
            ));
        }

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


    /**
     * @param $data
     * @return mixed
     */
    private function generateBranchesInRangesDocument($data){
        $phpExcelObject = $this->getExcelSkeleton();

        foreach($data['ranges'] as $rangeIndex => $range){
            $phpExcelObject->createSheet(NULL, $rangeIndex);

            $phpExcelObject->setActiveSheetIndex($rangeIndex)
                ->setCellValue('A1', 'Pobočka')
                ->setCellValue('B1', 'Obrat')
                ->setCellValue('C1', 'Počet prodaných zájezdů');

            $phpExcelObject->getActiveSheet()->setTitle('Zajezdy '. $range['min'] . '-'. $range['max']);

            $line = 2;
            foreach($range['branches'] as $branch){
                $phpExcelObject->setActiveSheetIndex($rangeIndex)
                    ->setCellValue('A'. $line, $branch['name'])
                    ->setCellValue('B'. $line, $branch['totalPrice'])
                    ->setCellValue('C'. $line, $branch['totalCount']);

                $line++;
            }
        }

        return $this->getExcelResponse($phpExcelObject, 'branches_range_'.$data['beginDate']->format('d-m-Y').'_'.$data['endDate']->format('d-m-Y').'.xls');
    }


    /**
     * @param $data
     * @return mixed
     */
    private function generateBranchesDocument($data){
        $phpExcelObject = $this->getExcelSkeleton();
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Pobočka')
            ->setCellValue('B1', 'Obrat')
            ->setCellValue('C1', 'Počet prodaných zájezdů');
        $phpExcelObject->getActiveSheet()->setTitle('Pobočky '. $data['beginDate']->format('d.m.Y'). '-' . $data['endDate']->format('d.m.Y'));

        $line = 2;
        foreach($data['branches'] as $branch){
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A'. $line, $branch['name'])
                ->setCellValue('B'. $line, $branch['totalPrice'])
                ->setCellValue('C'. $line, $branch['totalCount']);

            $line++;
        }

        return $this->getExcelResponse($phpExcelObject, 'branches_'.$data['beginDate']->format('d-m-Y').'_'.$data['endDate']->format('d-m-Y').'.xls');
    }


    /**
     * @param $data
     * @return mixed
     */
    private function generateMostPopularCountriesDocument($data){
        $phpExcelObject = $this->getExcelSkeleton();
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Destinace')
            ->setCellValue('B1', 'Vypsaných zájezdů')
            ->setCellValue('C1', 'Obrat všech zájezdů')
            ->setCellValue('D1', 'Průměrná cena zájezdu')
            ->setCellValue('E1', 'Počet prodaných zájezdů');
        $phpExcelObject->getActiveSheet()->setTitle('Zájezdy '. $data['beginDate']->format('d.m.Y'). '-' . $data['endDate']->format('d.m.Y'));

        $line = 2;
        foreach($data['countries'] as $country){
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A'. $line, $country['name'])
                ->setCellValue('B'. $line, $country['tripsCount'])
                ->setCellValue('C'. $line, $country['totalPrice'])
                ->setCellValue('D'. $line, ($country['totalCount'] != 0) ? $country['totalPrice'] / $country['totalCount'] : 'N/A')
                ->setCellValue('E'. $line, $country['totalCount']);

            $line++;
        }

        return $this->getExcelResponse($phpExcelObject, 'countries_'.$data['beginDate']->format('d-m-Y').'_'.$data['endDate']->format('d-m-Y').'.xls');
    }

    /**
     * @return \PHPExcel
     */
    private function getExcelSkeleton(){
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("Hermes")
            ->setTitle("Office 2005 XLSX Test Document");

        return $phpExcelObject;
    }


    /**
     * @param \PHPExcel $phpExcelObject
     * @param $name
     * @return mixed
     */
    private function getExcelResponse(\PHPExcel $phpExcelObject, $name){
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename='.$name);
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }

} 
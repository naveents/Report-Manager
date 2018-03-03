<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\ReportType;
use AppBundle\Entity\ReportRequest;
use AppBundle\Entity\ReportMaster;
use Shared\Util\DateTimeUtil;
use Shared\Util\Sanitize;

class ReportController extends Controller {
    var $date;     
    
    /**
     * @Route("/report/viewall", name="employee_report_view" )
     */
    
    public function viewallAction(Request $request) {
        
        $emp            = $request->query->get('emp');        
        $repository     = $this->getDoctrine()->getRepository(ReportMaster::class);
        $reports        = $repository->findByReportStatus("Approved");
        if(!$emp && !is_numeric($emp)){
            
             return new Response(
                    '<html><body>Employee id should be present in url! [ ?emp=1 ]</body></html>'
                );
            
        }
        return $this->render('report/viewall.html.twig', array(
            'reports' => $reports,'emp'=>$emp
        ));
    }
    
     
    /**
     * @Route("/report/create", name="create_new_report")
     */
    
    public function createAction(Request $request) {
        
        $emp          = $request->query->get('emp');        
        $repository   = $this->getDoctrine()->getRepository(ReportType::class);
        $report_types = $repository->findAll();
        
        if(!$emp && !is_numeric($emp)){
            
             return new Response(
                    '<html><body>Employee id should be present in url! [ ?emp=1 ]</body></html>'
                );
            
        }
        return $this->render('report/create.html.twig',array("report_types" => $report_types,"created_by"=>$emp));
    }
    
    /**
     * @Route("/report/logrequest", name="report_log_request")
     */
    public function logrequestAction(Request $request) {
        
        if ($request->getMethod() == Request::METHOD_POST) {

            $em = $this->getDoctrine()->getManager();
            
            $this->date = new \DateTime();
            $reportRequest = new ReportRequest();
            $reportRequest->setName($request->request->get('name'));        
            $reportRequest->setReportType($em->find('AppBundle:ReportType',$request->request->get('report_type_id')) );           
            $reportRequest->setPriority($request->request->get('priority'));
            $reportRequest->setCause($request->request->get('cause'));
            $reportRequest->setDescription($request->request->get('description'));
            $reportRequest->setCreatedOn( $this->date);
            $reportRequest->setCreatedBy($request->request->get('created_by'));
            $reportRequest->setLatitude($request->request->get('latitude'));
            $reportRequest->setLongitude($request->request->get('longitude'));
            $reportRequest->setReportStatus("New");

            $entityManager = $this->getDoctrine()->getManager();        
            $entityManager->persist($reportRequest); 
            $entityManager->flush();

            return $this->render('report/report_submitted.html.twig',array("status"=>'Your report id# '.$reportRequest->getId()." is submitted for approval."));
            //return new Response(');
          
        }
        
    }
    
    
     /**
     * @Route("/report/editrequest",name="report_edit_request")
     */
    
    public function editrequestAction(Request $request) {  
        
          $report_id = $request->query->get('report_id'); 
          $emp_id    = $request->query->get('emp_id'); 
          
          if( is_numeric($report_id) && is_numeric($emp_id)) {
              
               $em           = $this->getDoctrine()->getManager();
               $report       = $em->getRepository(ReportMaster::class)->find($report_id);
               
               $repository   = $this->getDoctrine()->getRepository(ReportType::class);
               $report_types = $repository->findAll();
               
               return $this->render('report/edit.html.twig',array("report_types" => $report_types,"emp"=>$emp_id,'report'=>$report));
              
          }
          else{
                 return new Response(
                    '<html><body>Invalid Edit Request!</body></html>'
                );
          }
        
    }
    
    /**
     * @Route("/report/updaterequest", name="report_update_request")
     */
    public function updaterequestAction(Request $request) {
        
            $report_id   = $request->request->get('report_id'); 
            $created_by  = $request->request->get('created_by'); 
            
            if ($request->getMethod() == Request::METHOD_POST) {
                
                    $em = $this->getDoctrine()->getManager();            
                    $this->date    = new \DateTime();
                    $reportRequest = new ReportRequest();
                    $reportRequest->setName($request->request->get('name'));        
                    $reportRequest->setReportType($em->find('AppBundle:ReportType',$request->request->get('report_type_id')) );           
                    $reportRequest->setPriority($request->request->get('priority'));
                    if($request->request->get('report_type_id')  == 1) {
                            $reportRequest->setCause($request->request->get('cause'));
                    }
                    $reportRequest->setDescription($request->request->get('description'));
                    $reportRequest->setMasterReportId($report_id);
                    $reportRequest->setCreatedOn( $this->date);
                    $reportRequest->setCreatedBy($created_by);
                    if($request->request->get('report_type_id')  == 2) {
                            $reportRequest->setLatitude($request->request->get('latitude'));
                            $reportRequest->setLongitude($request->request->get('longitude'));
                    }
                    $reportRequest->setReportStatus("Edited");

                    $entityManager = $this->getDoctrine()->getManager();        
                    $entityManager->persist($reportRequest); 
                    $entityManager->flush();

                    
                    //update report request
                    $em_up = $this->getDoctrine()->getManager();
                    $reportMaster = $em_up->getRepository(ReportMaster::class)->find($report_id);
                    $reportMaster->setEditStatus('On');
                    $em_up->flush();
                    
                    return $this->render('report/report_updated.html.twig',array("status"=>'Your report id# '.$report_id." is submitted for approval."));
                    
            }
            else{
                   return $this->redirectToRoute('employee_report_view', array('emp' => $created_by)); 
            }
        
        
        
    }
}
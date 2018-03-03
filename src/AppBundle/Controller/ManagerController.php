<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\ReportType;
use AppBundle\Entity\ReportRequest;
use AppBundle\Entity\ReportMaster;
use Symfony\Component\HttpFoundation\JsonResponse;

class ManagerController extends Controller {
   
    var $manager_id = null;
    
    public function getManagerId()
    {
        if ($this->manager_id === null) {
            $this->manager_id = 100;
        }
        return $this->manager_id;
    }
    
    /**
     * @Route("/manager/viewall", name="manager_report_viewer")
     */
    
    public function viewallAction() {
        
        
        $repository     = $this->getDoctrine()->getRepository(ReportRequest::class);
        $report_request      = $repository->findByReportStatus("New");
        $report_edit_request = $repository->findByReportStatus("Edited");

        return $this->render('manager/viewallapprovals.html.twig', array(
            'report_request' => $report_request, 'report_edit_request' => $report_edit_request
        ));
    }
    
     /**
     * @Route("/manager/approverequest",name="manager_approve_request")
     */
    
    public function approverequestAction(Request $request) {       

            
            $report_request_id = $request->request->get('report_request_id'); 
            
            if($report_request_id) {
                
                    $repository     = $this->getDoctrine()->getRepository(ReportRequest::class);
                    $report_request = $repository->findBy(array("id"=>$report_request_id));
                    $em             = $this->getDoctrine()->getManager(); 
                    
                    $reportMaster = new ReportMaster();
                    $reportMaster->setReportName($report_request[0]->getName());        
                    $reportMaster->setMasterReportType($em->find('AppBundle:ReportType',$report_request[0]->getReportType()->getId()));           
                    $reportMaster->setReportPriority($report_request[0]->getPriority());
                    $reportMaster->setReportCause($report_request[0]->getCause());
                    $reportMaster->setReportDescription($report_request[0]->getDescription());           
                    $reportMaster->setGeoLatitude($report_request[0]->getLatitude());
                    $reportMaster->setGeoLongitude($report_request[0]->getLongitude());
                    $reportMaster->setCreatedOn( $report_request[0]->getCreatedOn());
                    $reportMaster->setApprovedBy($this->getManagerId());
                    $reportMaster->setCreatedBy($report_request[0]->getCreatedBy());
                    $reportMaster->setReportStatus("Approved");
                    $reportMaster->setEditStatus("Off");

                    $entityManager = $this->getDoctrine()->getManager();        
                    $entityManager->persist($reportMaster); 
                    $entityManager->flush();
                    
                    //update report request
                    $em_up = $this->getDoctrine()->getManager();
                    $reportRequest = $em_up->getRepository(ReportRequest::class)->find($report_request_id);
                    $reportRequest->setMasterReportId($reportMaster->getId());
                    $reportRequest->setReportJustification($request->request->get('report_justification'));
                    $reportRequest->setReportStatus('Archieved');
                    $em_up->flush();
                    
                    $arrData = ['message' => 'Report Approved Successfully!'];
                    return new JsonResponse($arrData);
            }
            else{
                    $arrData = ['message' => 'Error!'];
                    return new JsonResponse($arrData);
            }
    }
    
    /**
     * @Route("/manager/rejectrequest",name="manager_reject_request")
     */
    
    public function rejectrequestAction(Request $request) {       

            
            $report_request_id    = $request->request->get('report_request_id'); 
            $report_justification = $request->request->get('report_justification');
            
            if($report_request_id) {
                
                    $em_up = $this->getDoctrine()->getManager();
                    $reportRequest = $em_up->getRepository(ReportRequest::class)->find($report_request_id);                   
                    $reportRequest->setReportJustification($report_justification);
                    $reportRequest->setReportStatus('Deleted');
                    $em_up->flush();                    
                    $arrData = ['message' => 'Report Deleted Successfully!'];
                    return new JsonResponse($arrData);
                
            }
            else{
                    $arrData = ['message' => 'Error!'];
                    return new JsonResponse($arrData);
            }
            
    }//delete new report request
    
    
    
    
    
    /**
     * @Route("/manager/approveeditrequest",name="manager_approve_edit_request")
     */
    
    public function approveeditrequestAction(Request $request) {       

            
            $report_request_id    = $request->request->get('report_request_id'); 
            $report_justification = $request->request->get('report_justification');
            
            if($report_request_id) {
                
                    $repository     = $this->getDoctrine()->getRepository(ReportRequest::class);
                    $report_request = $repository->findBy(array("id"=>$report_request_id));
                    
                    //echo "<pre>"; print_r($report_request[0]); exit;
                    
                    $em             = $this->getDoctrine()->getManager();                   
                    $report_type_obj = $em->find('AppBundle:ReportType',$report_request[0]->getReportType()->getId());
                   // echo $report_request[0]->getReportMasterId(); exit;
                    
                    
                    $em_rm        = $this->getDoctrine()->getManager();
                    $reportMaster = $em_rm->getRepository(ReportMaster::class)->find($report_request[0]->getMasterReportId());
                    $reportMaster->setReportName($report_request[0]->getName());        
                    $reportMaster->setMasterReportType($report_type_obj);           
                    $reportMaster->setReportPriority($report_request[0]->getPriority());
                    $reportMaster->setReportCause($report_request[0]->getCause());
                    $reportMaster->setReportDescription($report_request[0]->getDescription());           
                    $reportMaster->setGeoLatitude($report_request[0]->getLatitude());
                    $reportMaster->setGeoLongitude($report_request[0]->getLongitude());
                    $reportMaster->setUpdatedOn( $report_request[0]->getCreatedOn());
                    $reportMaster->setApprovedBy($this->getManagerId());                   
                    $reportMaster->setReportStatus("Approved");
                    $reportMaster->setEditStatus("Off");
                    $em_rm->flush();
                    
                    //update report request
                    $em_up = $this->getDoctrine()->getManager();
                    $reportRequest = $em_up->getRepository(ReportRequest::class)->find($report_request_id);
                    $reportRequest->setReportJustification($report_justification);
                    $reportRequest->setReportStatus('Archieved');
                    $em_up->flush();
                    
                    $arrData = ['message' => 'Report Approved Successfully!'];
                    return new JsonResponse($arrData);
            }
            else{
                    $arrData = ['message' => 'Error!'];
                    return new JsonResponse($arrData);
            }
    }
    
    /**
     * @Route("/manager/rejecteditrequest",name="manager_reject_edit_request")
     */
    
    public function rejecteditrequestAction(Request $request) {       

            
            $report_request_id    = $request->request->get('report_request_id'); 
            $report_justification = $request->request->get('report_justification');
            
            if($report_request_id) {
                
                    $em_up = $this->getDoctrine()->getManager();
                    $reportRequest = $em_up->getRepository(ReportRequest::class)->find($report_request_id);                   
                    $reportRequest->setReportJustification($report_justification);
                    $reportRequest->setReportStatus('Deleted');
                    $master_report_id = $reportRequest->getMasterReportId();
                    $em_up->flush();                    
                    
                    //update master report edit status
                    $em_rm        = $this->getDoctrine()->getManager();
                    $reportMaster = $em_rm->getRepository(ReportMaster::class)->find($master_report_id);
                    $reportMaster->setEditStatus("Off");
                    $em_rm->flush();
                    
                    $arrData = ['message' => 'Report Deleted Successfully!'];
                    return new JsonResponse($arrData);
                
            }
            else{
                    $arrData = ['message' => 'Error!'];
                    return new JsonResponse($arrData);
            }
            
            
    }//reject edit request
    

}
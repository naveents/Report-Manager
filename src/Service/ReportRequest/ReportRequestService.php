<?php

namespace Service\ReportRequest;
use AppBundle\Entity\ReportRequest;
use Shared\Util\DateTimeUtil;
use Shared\Util\Sanitize;
use Symfony\Component\HttpFoundation\RequestStack;
use View\ReportRequest\ReportRequestView;

class ReportRequestService
{
    private $requestStack;
    private $request; 

    public function __construct(RequestStack $requestStack )
    {
        $this->requestStack = $requestStack;
        $this->request = $requestStack->getCurrentRequest();  
    }

    public function convertRequestToView() {

        $reportRequestView = new ReportRequestView();
        $reportRequestView->setName(Sanitize::requestParamValueOf($this->request->request->get('name')));
        $reportRequestView->setReportTypeId(Sanitize::requestParamValueOf($this->request->request->get('report_type_id')));
        $reportRequestView->setPriority(Sanitize::requestParamValueOf($this->request->request->get('priority')));
        $reportRequestView->setCause(Sanitize::requestParamValueOf($this->request->request->get('cause')));
        $reportRequestView->setDescription(Sanitize::requestParamValueOf($this->request->request->get('description')));
        $reportRequestView->setCreatedOn(DateTimeUtil::currentDateTime());
        $reportRequestView->setCreatedBy(Sanitize::requestParamValueOf($this->request->request->get('created_by')));
        $reportRequestView->setLatitude(Sanitize::requestParamValueOf($this->request->request->get('latitude')));
        $reportRequestView->setLongitude(Sanitize::requestParamValueOf($this->request->request->get('longitude')));
        $reportRequestView->setReportStatus("New");
        return $reportRequestView;
    }

}

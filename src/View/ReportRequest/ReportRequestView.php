<?php

namespace View\ReportRequest;

class ReportRequestView
{
    private $id;

    //@Assert\NotBlank(message="Report name cannot be blank")
    private $name;

    //@Assert\NotBlank(message="Description cannot be blank")
    private $description;

    private $reportTypeId;

    private $priority;

    private $cause;
   
    private $latitude;
    
    private $longitude;
    
    private $createdBy;
    
    private $createdOn;
    
    private $reportStatus;
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getReportTypeId()
    {
        return $this->reportTypeId;
    }
    
    public function setReportTypeId($reportTypeId)
    {
        $this->reportTypeId = $reportTypeId;
    }
    
    public function getPriority()
    {
        return $this->priority;
    }
    
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
    
    public function getCause()
    {
        return $this->cause;
    }
    
    public function setCause($cause)
    {
        $this->cause = $cause;
    }
    
     public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }
    
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
    
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
    
    public function setCreatedOn($createdon)
    {
        $this->createdOn = $createdon;
    }
    
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    
    public function setCreatedBy($createdby)
    {
        $this->createdBy = $createdby;
    }
    
    public function setReportStatus($status)
    {
        $this->reportStatus = $status;
    }
    
    public function getReportStatus()
    {
        $this->reportStatus;
    }
}

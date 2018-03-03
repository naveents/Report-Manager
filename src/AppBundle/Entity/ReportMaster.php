<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportMaster
 *
 * @ORM\Table(name="report_master")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportMasterRepository")
 */
class ReportMaster
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(type="string",name="report_name",nullable=false, length=150)
     */
    private $reportName;
     
        
    /**
     * @ORM\Column(type="string",name="report_priority",nullable=false, length=20)
     */
    private $reportPriority;
    
    /**
     * @ORM\Column(type="text",name="report_description",nullable=true)
     */
    private $reportDescription;
     
    /**
     * @ORM\Column(type="text",name="report_cause",nullable=true)
     */
    private $reportCause;
    
    /**
     * @ORM\Column(name="geo_latitude", type="decimal", precision=11, scale=8, unique=false, nullable=true)
     * Example: ##.#########
     */
    
    private $geoLatitude;
    
    /**
     * @ORM\Column(name="geo_longitude", type="decimal", precision=11, scale=8, unique=false, nullable=true)
     * Example: ##.#########
     */
    
    private $geoLongitude;
    
    /**
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;
    
    /**
     * @ORM\Column(name="approved_by", type="integer", nullable=false)
     */
    private $approvedBy;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;
    
    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;
    
    /**
     * @ORM\Column(name="report_status", type="string" ,columnDefinition="ENUM('Approved','Rejected')")
     */
    private $reportStatus;
    
     /**
     * @ORM\Column(name="edit_status", type="string" ,columnDefinition="ENUM('On','Off')")
     */
    private $editStatus;    

    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ReportType", inversedBy="reportMaster")
     * @ORM\JoinColumn(name="report_master_type_id", referencedColumnName="id")
     */
    private $masterReportType;

    
    /**
     * @return mixed
     */
    public function getMasterReportType()
    {
        return $this->masterReportType;
    }

    /**
     * @param mixed $reportType
     */
    public function setMasterReportType($reportType)
    {
        $this->masterReportType = $reportType;
    }
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
     public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getReportName()
    {
        return $this->reportName;
    }
    
    public function setReportName($name)
    {
        $this->reportName = $name;
    }   
   
    
    public function getReportPriority()
    {
        return $this->reportPriority;
    }
    
    public function setReportPriority($priority)
    {
        $this->reportPriority = $priority;
    }
    
    public function getReportCause()
    {
        return $this->reportCause;
    }
    
    public function setReportCause($cause)
    {
        $this->reportCause = $cause;
    }
    
     public function getReportDescription()
    {
        return $this->reportDescription;
    }
    
    public function setReportDescription($description)
    {
        $this->reportDescription = $description;
    }
    
    public function getGeoLatitude()
    {
        return $this->geoLatitude;
    }
    
    public function setGeoLatitude($latitude)
    {
        $this->geoLatitude = $latitude;
    }
    
    public function getGeoLongitude()
    {
        return $this->geoLongitude;
    }
    
    public function setGeoLongitude($longitude)
    {
        $this->geoLongitude = $longitude;
    }
    
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
    
    public function setCreatedOn($createdon)
    {
        $this->createdOn = $createdon;
    }
    
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
    
    public function setUpdatedOn($updatedon)
    {
        $this->updatedOn = $updatedon;
    }
    
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    
    public function setCreatedBy($createdby)
    {
        $this->createdBy = $createdby;
    }
    
    public function getApprovedBy()
    {
        return $this->approvedBy;
    }
    
    public function setApprovedBy($approvedby)
    {
        $this->approvedBy = $approvedby;
    }
    
    public function setReportStatus($status)
    {
        $this->reportStatus = $status;
    }
    
    public function getReportStatus()
    {
       return $this->reportStatus;
    }
    
    public function setEditStatus($status)
    {
        $this->editStatus = $status;
    }
    
    public function getEditStatus()
    {
       return $this->editStatus;
    }
}

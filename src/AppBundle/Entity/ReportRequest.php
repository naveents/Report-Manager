<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportTemp
 *
 * @ORM\Table(name="report_request")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportRequestRepository")
 */
class ReportRequest
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
     * @ORM\Column(name="master_report_id", type="integer",nullable=true)
     */
    private $masterReportId;
    
    /**
     * @ORM\Column(type="string",name="report_name",nullable=false, length=150)
     */
     //@Assert\NotBlank(message="Report name cannot be blank")
    private $name;
     
        
    /**
     * @ORM\Column(type="string",name="priority",nullable=false, length=20)
     */
    private $priority;
    
     /**
     * @ORM\Column(type="text",name="description",nullable=true)
     */
     //@Assert\NotBlank(message="Report description cannot be blank")
    private $description;
     
    /**
     * @ORM\Column(type="text",name="cause",nullable=true)
     */
    private $cause;
    
    /**
     * @ORM\Column(name="latitude", type="decimal", precision=11, scale=8, unique=false, nullable=true)
     * Example: ##.#########
     */
    
    private $latitude;
    
    /**
     * @ORM\Column(name="longitude", type="decimal", precision=11, scale=8, unique=false, nullable=true)
     * Example: ##.#########
     */
    
    private $longitude;
    
     /**
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=false, unique=false)
     */
    private $createdOn;
    
    /**
     * @ORM\Column(name="report_status", type="string" ,columnDefinition="ENUM('New','Edited','Deleted','Archieved')")
     */
    private $reportStatus;

    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ReportType", inversedBy="reportRequest")
     * @ORM\JoinColumn(name="report_type_id", referencedColumnName="id")
     */
    private $reportType;
    
   
    /**
     * @ORM\Column(name="report_justification", type="text", nullable=true)
     */
    private $reportJustification;

    
     /**
     * @return mixed
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * @param mixed $reportType
     */
    public function setReportType($reportType)
    {
        $this->reportType = $reportType;
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
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
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
        return $this->reportStatus;
    }
    
    public function setMasterReportId($masterReportId)
    {
        $this->masterReportId = $masterReportId;
    }
    
    public function getMasterReportId()
    {
        return $this->masterReportId;
    }
    
    public function setReportJustification($reportJustification)
    {
        $this->reportJustification = $reportJustification;
    }
    
    public function getReportJustification()
    {
        return $this->reportJustification;
    }
}

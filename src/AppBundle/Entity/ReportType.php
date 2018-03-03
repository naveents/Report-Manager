<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ReportType
 *
 * @ORM\Table(name="report_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportTypeRepository")
 */
class ReportType
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
     * @ORM\Column(type="string",name="report_type_name",nullable=false, length=50)
     */
    private $reportTypeName;
    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ReportRequest", mappedBy="reportType")
     */
    private $reportRequest;
    
     /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ReportMaster", mappedBy="masterReportType")
     */
    private $reportMaster;
    
    
    public function __construct()
    {
        $this->reportRequest = new ArrayCollection();
        $this->reportMaster = new ArrayCollection();
        
    }
    
    
    public function getReportRequest(){

        return $this->reportRequest;
    }
    
    public function getReportMaster(){

        return $this->reportMaster;
    }
    

    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

   
    /**
     * @return mixed
     */
    public function getReportTypeName()
    {
        return $this->reportTypeName;
    }

    /**
     * @param mixed $reportTypeName
     */
    public function setReportTypeName($reportTypeName)
    {
        $this->reportTypeName = $reportTypeName;
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
}

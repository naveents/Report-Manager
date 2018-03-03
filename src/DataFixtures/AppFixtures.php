<?php
namespace App\DataFixtures;

use AppBundle\Entity\ReportType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $array_report_types = array("Site Report", "General Report");        
       
        for ($i = 0; $i < count($array_report_types); $i++) {
            $reportType = new ReportType();
            $reportType->setReportTypeName($array_report_types[$i]);           
            $manager->persist($reportType);
        }

        $manager->flush();
    }
}
<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Udf.php';


class ReportCounts extends Database
{
    public function getTotalSubmittedForms()
    {
        $this->sql = "SELECT COUNT(*) as total FROM graduates";
        return $this->fetch()['total'] ?? 0;
    }

    public function getTotalStudentVerification()
    {
        $this->sql = "SELECT COUNT(*) as total FROM verification_requests";
        return $this->fetch()['total'] ?? 0;
    }

    public function getTotalGraphicalReports()
    {
        $this->sql = "SELECT COUNT(*) as total FROM graphical_reports";
        return $this->fetch()['total'] ?? 0;
    }

    public function getTotalMisalignmentReports()
    {
        $this->sql = "SELECT COUNT(*) as total FROM misalignment_reports";
        return $this->fetch()['total'] ?? 0;
    }

    public function getTotalFormsVerification()
    {
        return $this->getTotalSubmittedForms() + $this->getTotalStudentVerification();
    }

    public function getTotalGraphReports()
    {
        return $this->getTotalGraphicalReports() + $this->getTotalMisalignmentReports();
    }
}


$reportCounts = new ReportCounts();
$totalFormsVerification = $reportCounts->getTotalFormsVerification();
$totalGraphReports = $reportCounts->getTotalGraphReports();
?>
<?php
include_once 'dash.php';
require_once __DIR__ . '/../models/report.php';

$reportCounts = new ReportCounts();
$totalFormsVerification = $reportCounts->getTotalFormsVerification();
$totalGraphReports = $reportCounts->getTotalGraphReports();


$submittedForms = $db->query("SELECT COUNT(*) as total FROM graduates")->fetch()['total'];
$studentVerification = $db->query("SELECT COUNT(*) as total FROM student_verification")->fetch()['total'];
$graphicalReports = $db->query("SELECT COUNT(*) as total FROM graphical_reports")->fetch()['total'];
$misalignmentReports = $db->query("SELECT COUNT(*) as total FROM misalignment_reports")->fetch()['total'];

$totalFormsVerification = $submittedForms + $studentVerification;
$totalGraphReports = $graphicalReports + $misalignmentReports;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Dashboard Overview</h2>

        <!-- Total for Submitted Forms & Student Verification -->
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-primary text-white text-center p-3">
                    <h5>Submitted Forms & Student Verification</h5>
                    <p><?php echo $totalFormsVerification; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-dark text-white text-center p-3">
                    <h5>Total Reports (Graphical & Misalignment)</h5>
                    <p><?php echo $totalGraphReports; ?></p>
                </div>
            </div>
        </div>

        <!-- Graph (Only for Graphical Reports & Misalignment Reports) -->
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="reportChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
    var ctx = document.getElementById('reportChart').getContext('2d');
    var reportChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Graphical Reports', 'Misalignment Reports'],
            datasets: [{
                label: 'Total Reports',
                data: [<?php echo "$graphicalReports, $misalignmentReports"; ?>],
                backgroundColor: ['green', 'orange']
            }]
        }
    });
    </script>

</body>

</html>
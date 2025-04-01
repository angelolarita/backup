<?php
include_once 'dash.php';
include(__DIR__ . "/../includes/db_connect.php");


// Approve Request
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];

    // Get user email and student number
    $stmt = $pdo->prepare("SELECT email, student_number FROM verification_requests WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $email = $user['email'];
        $student_number = $user['student_number'];

        // Update graduates table
        $stmt = $pdo->prepare("UPDATE graduates SET status = 'approved' WHERE student_number = ?");
        $stmt->execute([$student_number]);

        // Update verification_requests table
        $stmt = $pdo->prepare("UPDATE verification_requests SET status = 'approved' WHERE id = ?");
        $stmt->execute([$id]);

        // Call email sending script asynchronously (non-blocking)
        file_get_contents("http://localhost/dashboard/admin/send_email.php?email=" . urlencode($email));

        echo "<script>alert('User approved successfully! Email will be sent shortly.'); window.location.href='verify.php';</script>";
    }
}

// Reject Request
if (isset($_GET['reject'])) {
    $id = $_GET['reject'];

    $stmt = $pdo->prepare("UPDATE graduates SET status = 'rejected' WHERE student_number = 
                           (SELECT student_number FROM verification_requests WHERE id = ?)");
    $stmt->execute([$id]);

    $stmt = $pdo->prepare("UPDATE verification_requests SET status = 'rejected' WHERE id = ?");
    $stmt->execute([$id]);

    echo "<script>alert('User rejected successfully!'); window.location.href='verify.php';</script>";
}

// Fetch verification requests
$query = "SELECT * FROM verification_requests ORDER BY request_date DESC";
$stmt = $pdo->query($query);
$verificationRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Requests</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #004085;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .actions a {
        text-decoration: none;
        padding: 8px 12px;
        margin: 2px;
        display: inline-block;
        border-radius: 5px;
    }

    .approve {
        background-color: green;
        color: white;
    }

    .reject {
        background-color: red;
        color: white;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>Verification Requests</h2>
        <div class="table-container">
            <table border="1">
                <tr>
                    <th>Course</th>
                    <th>Name</th>
                    <th>Student Number</th>
                    <th>Graduation Year</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($verificationRequests as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] .' '. $row['last_name']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['student_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['graduation_year']); ?></td>
                    <td><?php echo htmlspecialchars($row['request_date']); ?></td>
                    <td><?php echo ucfirst(htmlspecialchars($row['status'])); ?></td>
                    <td class="actions">
                        <?php if ($row['status'] === 'pending') { ?>
                        <a href="?approve=<?php echo $row['id']; ?>" class="approve"
                            onclick="return confirm('Approve this user?');">Approve</a>
                        <a href="?reject=<?php echo $row['id']; ?>" class="reject"
                            onclick="return confirm('Reject this user?');">Reject</a>
                        <?php } else { ?>
                        <?php echo ucfirst(htmlspecialchars($row['status'])); ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>

</html>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <span id="modalAction"></span> this user?
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="id" id="modalId">
                    <input type="hidden" name="action" id="modalActionInput">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="approvedModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="alert alert-success" role="alert">
                    ✅ <strong>Approved Successfully!</strong>
                </div>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('confirmModal').addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const action = button.getAttribute('data-action');

    document.getElementById('modalId').value = id;
    document.getElementById('modalActionInput').value = action;
    document.getElementById('modalAction').textContent = action === 'approve' ? 'approve' : 'reject';
});




document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        var loadingScreen = document.getElementById("loading");
        if (loadingScreen) {
            loadingScreen.classList.add("hidden");
            setTimeout(function() {
                loadingScreen.style.display = "none";
            }, 1000);
        }
    }, 3000);
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
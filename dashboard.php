<div id="loading">
    <img src="assets/img/acts.png" alt="Loading...">
</div>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center">
        <button class="btn btn-dark me-2" id="menuToggle">☰</button>
        <a class="navbar-brand me-auto" href="#">Alumni Tracer System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-black" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="controllers/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-4 col-lg-3 d-md-block bg-white sidebar text-white min-vh-100 p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>"
                        href="../Dashboard/login.php">
                        <img src="assets/img/speedometer.png" width="20" height="20" alt="Dashboard" class="me-2">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center <?php echo basename($_SERVER['PHP_SELF']) == 'form.php' ? 'active' : '';?>"
                        href="../Dashboard/form.php">
                        <img src="assets/img/student.png" width="20" height="20" alt="Submitted Forms" class="me-2">
                        Submitted Forms
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center <?php echo basename($_SERVER['PHP_SELF']) == 'verify' ? 'active' : '';?>"
                        href="#reports">
                        <img src="assets/img/growth.png" width="20" height="20" alt="Graphical Reports" class="me-2">
                        Graphical Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center <?php echo basename($_SERVER['PHP_SELF']) == 'verify' ? 'active' : '';?>"
                        href="#reports">
                        <img src="assets/img/alignment.png" width="20" height="20" alt="Misalignment Report"
                            class="me-2">
                        Misalignment Report
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center <?php echo basename($_SERVER['PHP_SELF']) == 'verify.php' ? 'active' : '';?>"
                        href="../Dashboard/verify.php">
                        <img src="assets/img/immigration.png" width="20" height="20" alt="Student Verification"
                            class="me-2">
                        Student Verification
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex align-items-center <?php echo basename($_SERVER['PHP_SELF']) == 'user.php' ? 'active' : ''; ?>"
                        href="../Dashboard/user.php">
                        <img src="assets/img/team.png" width="20" height="20" alt="User Management" class="me-2">
                        User Management
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left info">
                <h4>
                    <?php 
                    if ($_SESSION['role'] == "Zone Leader") {
                        echo 'Hello, ' . $_SESSION['barangay'];
                    } else {
                        echo 'Hello, ' . $_SESSION['role'];
                    }
                    ?>
                </h4>
            </div>
        </div>
        <ul class="sidebar-menu">
            <?php if ($_SESSION['role'] == "Administrator"): ?>
                <li><a href="../dashboard/dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="../officials/officials.php"><i class="fa fa-user"></i> <span>Barangay Officials</span></a></li>
                <li><a href="../staff/staff.php"><i class="fa fa-user"></i> <span>Staff</span></a></li>
                <li><a href="../zone/zone.php"><i class="fa fa-user"></i> <span>Zone/Purok Leader</span></a></li>
                <li><a href="../household/household.php"><i class="fa fa-home"></i> <span>Household</span></a></li>
                <li><a href="../resident/resident.php"><i class="fa fa-users"></i> <span>Resident</span></a></li>
                <li><a href="../permit/permit.php"><i class="fa fa-file"></i> <span>Permit</span></a></li>
                <li><a href="../blotter/blotter.php"><i class="fa fa-users"></i> <span>Blotter</span></a></li>
                <li><a href="../clearance/clearance.php"><i class="fa fa-file"></i> <span>Clearance</span></a></li>
                <li><a href="../activity/activity.php"><i class="fa fa-calendar"></i> <span>Activity</span></a></li>
                <li><a href="../project/project.php"><i class="fa fa-calendar"></i> <span>Project</span></a></li>
                <li><a href="../session/session.php"><i class="fa fa-calendar"></i> <span>Session</span></a></li>
                <li><a href="../archive/archive.php"><i class="fa fa-archive"></i> <span>Archive</span></a></li>
                <li><a href="../visitor/visitor.php"><i class="fa fa-users"></i> <span>Visitors</span></a></li>
                <li><a href="../report/report.php"><i class="fa fa-file"></i> <span>Report</span></a></li>
                <li><a href="../logs/logs.php"><i class="fa fa-history"></i> <span>Logs</span></a></li>
                <li><a href="../settings/settings.php"><i class="fa fa-gear"></i> <span>Settings</span></a></li>
            <?php elseif ($_SESSION['role'] == "Zone Leader"): ?>
                <li><a href="../permit/permit.php"><i class="fa fa-file"></i> <span>Permit</span></a></li>
                <li><a href="../clearance/clearance.php"><i class="fa fa-file"></i> <span>Clearance</span></a></li>
                <li><a href="../activity/activity.php"><i class="fa fa-calendar"></i> <span>Activity</span></a></li>
            <?php elseif (isset($_SESSION['staff'])): ?>
                <li><a href="../officials/officials.php"><i class="fa fa-user"></i> <span>Barangay Officials</span></a></li>
                <li><a href="../household/household.php"><i class="fa fa-home"></i> <span>Household</span></a></li>
                <li><a href="../resident/resident.php"><i class="fa fa-users"></i> <span>Resident</span></a></li>
                <li><a href="../zone/zone.php"><i class="fa fa-user"></i> <span>Zone Leader</span></a></li>
                <li><a href="../permit/permit.php"><i class="fa fa-file"></i> <span>Permit</span></a></li>
                <li><a href="../blotter/blotter.php"><i class="fa fa-users"></i> <span>Blotter</span></a></li>
                <li><a href="../clearance/clearance.php"><i class="fa fa-file"></i> <span>Clearance</span></a></li>
                <li><a href="../activity/activity.php"><i class="fa fa-calendar"></i> <span>Activity</span></a></li>
            <?php else: ?>
                <li><a href="../permit/permit.php"><i class="fa fa-file"></i> <span>Permit</span></a></li>
                <li><a href="../clearance/clearance.php"><i class="fa fa-file"></i> <span>Clearance</span></a></li>
                <li><a href="../activity/activity.php"><i class="fa fa-calendar"></i> <span>Activity</span></a></li>
            <?php endif; ?>
        </ul>
    </section>
</aside>

<style>
     .left-side.sidebar-offcanvas {
            background-color: white !important;
            border-right: 1px solid black !important;
            box-shadow: 3px 0px 10px rgba(0, 0, 0, 0.6);
        }
        .user-panel h4 {
            margin: 0;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
        }
        .sidebar-menu li {
            padding: 10px;
        }
        .sidebar-menu a {
            text-decoration: none;
            color: black;
            display: flex;
            align-items: center;
        }
        .sidebar-menu a i {
            margin-right: 10px;
        }
</style>

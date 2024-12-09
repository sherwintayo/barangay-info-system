<?php


echo '
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left info">
';

if ($_SESSION['role'] === 'administrator') {
    echo '<h4>Hello, ' . $_SESSION['role'] . '</h4>';
} else {
    echo '<h4>Barangay ' . $_SESSION['barangay'] . '</h4>';
}

echo '
                </div>
            </div>
';

if ($_SESSION['role'] == "administrator") {
    $today = date('Y-m-d');

    $count_permit = $con->query("SELECT * FROM tblpermit WHERE DATE(dateRecorded) = '$today'");

   ?>
    <ul class="sidebar-menu">
            <li>
                <a href="../dashboard/dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../officials/officials.php">
                    <i class="fa fa-user"></i> <span>Barangay Officials</span>
                </a>
            </li>
             <li>
                <a href="../user/user.php">
                    <i class="fa fa-user"></i> <span>Users</span>
                </a>
            </li>
            <li>
                <a href="../household/household.php">
                    <i class="fa fa-home"></i> <span>Household</span>
                </a>
            </li>
            <li>
                <a href="../resident/resident.php">
                    <i class="fa fa-users"></i> <span>Resident</span>
                </a>
            </li>
            <li>
                <a href="../settings/settings.php">
                    <i class="fa fa-gear"></i> <span>Settings</span>
                </a>
            </li>
        </ul>
   <?php 
} elseif ($_SESSION['role'] == "Zone Leader") {
   ?>
    <ul class="sidebar-menu">
            <li>
                <a href="../dashboard/dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../officials/officials.php">
                    <i class="fa fa-user"></i> <span>Barangay Officials</span>
                </a>
            </li>
            <li>
                <a href="../staff/staff.php">
                    <i class="fa fa-user"></i> <span>Staff</span>
                </a>
            </li>
            <!-- <li>
                <a href="../zone/zone.php">
                    <i class="fa fa-user"></i> <span>Zone/Purok Leader</span>
                </a>
            </li> -->
            <li>
                <a href="../purok/purok.php">
                    <i class="fa fa-users"></i> <span>Puroks</span>
                </a>
            </li>
            <li>
                <a href="../household/household.php">
                    <i class="fa fa-home"></i> <span>Household</span>
                </a>
            </li>
            <li>
                <a href="../resident/resident.php">
                    <i class="fa fa-users"></i> <span>Resident</span>
                </a>
            </li>
            <li>
                <a href="../permit/permit.php">
                    <i class="fa fa-file"></i> <span>Permit</span>
                </a>
            </li>
            <li>
                <a href="../blotter/blotter.php">
                    <i class="fa fa-users"></i> <span>Blotter</span>
                </a>
            </li>
            <li>
                <a href="../clearance/clearance.php">
                    <i class="fa fa-file"></i> <span>Clearance</span>
                </a>
            </li>
            <li>
                <a href="../activity/activity.php">
                    <i class="fa fa-calendar"></i> <span>Activity</span>
                </a>
            </li>
            <li>
                <a href="../project/project.php">
                    <i class="fa fa-calendar"></i> <span>Project</span>
                </a>
            </li>
            <li>
                <a href="../session/session.php">
                    <i class="fa fa-calendar"></i> <span>Session</span>
                </a>
            </li>
            <li>
                <a href="../archive/archive.php">
                    <i class="fa fa-archive"></i> <span>Archive</span>
                </a>
            </li>
            <!-- <li>
                <a href="../visitor/visitor.php">
                    <i class="fa fa-users"></i> <span>Visitors</span>
                </a>
            </li> -->
            <li>
                <a href="../report/report.php">
                    <i class="fa fa-file"></i> <span>Report</span>
                </a>
            </li>
                    <li>
                <a href="../settings/settings.php">
                    <i class="fa fa-gear"></i> <span>Settings</span>
                </a>
            </li>
             <li>
                <a href="../table/table.php">
                    <i class="fa fa-gear"></i> <span>Settings</span>
                </a>
            </li>
            <!-- <li>
                <a href="../logs/logs.php">
                    <i class="fa fa-history"></i> <span>Logs</span>
                </a>
            </li> -->
        </ul>
   <?php 
} elseif (isset($_SESSION['staff'])) {
    echo '
        <ul class="sidebar-menu">
            <li>
                <a href="../officials/officials.php">
                    <i class="fa fa-user"></i> <span>Barangay Officials</span>
                </a>
            </li>
            <li>
                <a href="../household/household.php">
                    <i class="fa fa-home"></i> <span>Household</span>
                </a>
            </li>
            <li>
                <a href="../resident/resident.php">
                    <i class="fa fa-users"></i> <span>Resident</span>
                </a>
            </li>
            <li>
                <a href="../zone/zone.php">
                    <i class="fa fa-user"></i> <span>Zone Leader</span>
                </a>
            </li>
            <li>
                <a href="../permit/permit.php">
                    <i class="fa fa-file"></i> <span>Permit</span>
                </a>
            </li>
            <li>
                <a href="../blotter/blotter.php">
                    <i class="fa fa-users"></i> <span>Blotter</span>
                </a>
            </li>
            <li>
                <a href="../clearance/clearance.php">
                    <i class="fa fa-file"></i> <span>Clearance</span>
                </a>
            </li>
            <li>
                <a href="../activity/activity.php">
                    <i class="fa fa-calendar"></i> <span>Activity</span>
                </a>
            </li>
        </ul>';
} else {
    echo '
        <ul class="sidebar-menu">
            <li>
                <a href="../permit/permit.php">
                    <i class="fa fa-file"></i> <span>Permit</span>
                </a>
            </li>
            <li>
                <a href="../clearance/clearance.php">
                    <i class="fa fa-file"></i> <span>Clearance</span>
                </a>
            </li>
            <li>
                <a href="../activity/activity.php">
                    <i class="fa fa-calendar"></i> <span>Activity</span>
                </a>
            </li>
        </ul>';
}
echo '
        </section>
    </aside>
';
?>
<style>
     .left-side.sidebar-offcanvas {
            background-color: white !important;
            border-right: 1px solid black !important;
            box-shadow: 3px 0px 10px rgba(0, 0, 0, 0.6);
            height: 100vh; /* Make the sidebar height cover the viewport */
            overflow-y: auto; /* Enable vertical scrolling if content exceeds height */
        }
        .user-panel h4 {
            margin: 0;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0; /* Remove default margin for better alignment */
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

        /* Optional: Add styling for the scrollbar */
        .left-side.sidebar-offcanvas::-webkit-scrollbar {
            width: 8px;
        }
        .left-side.sidebar-offcanvas::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }
        .left-side.sidebar-offcanvas::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }
</style>

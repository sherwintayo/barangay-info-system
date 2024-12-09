<?php
echo '
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="path/to/default-avatar.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>';
if ($_SESSION['role'] === 'administrator') {
    echo 'Hello, ' . $_SESSION['role'];
} else {
    echo 'Barangay ' . $_SESSION['barangay'];
}
echo '</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu">';
if ($_SESSION['role'] == "administrator") {
    $today = date('Y-m-d');
    $count_permit = $con->query("SELECT * FROM tblpermit WHERE DATE(dateRecorded) = '$today'");
    ?>
        <li class="active">
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
    <?php 
} elseif ($_SESSION['role'] == "Zone Leader") {
    ?>
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
    <?php 
} elseif (isset($_SESSION['staff'])) {
    ?>
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
    <?php 
} else {
    ?>
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
    <?php 
}
echo '
        </ul>
        </section>
    </aside>';
?>
<stye>
### Enhanced CSS Styling:
```css
/* General Sidebar Enhancements */
.left-side.sidebar-offcanvas {
    background-color: #2c3e50 !important;
    color: #ecf0f1;
    border-right: 1px solid #34495e;
    box-shadow: 3px 0px 10px rgba(0, 0, 0, 0.6);
    height: 100vh; /* Full-height sidebar */
    overflow-y: auto;
}

.user-panel {
    padding: 15px;
    background: #34495e;
    text-align: center;
    border-bottom: 1px solid #7f8c8d;
}

.user-panel img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu li {
    padding: 12px 20px;
    transition: background-color 0.3s ease;
}

.sidebar-menu li:hover {
    background-color: #2980b9;
}

.sidebar-menu a {
    text-decoration: none;
    color: #ecf0f1;
    display: flex;
    align-items: center;
    font-size: 16px;
}

.sidebar-menu a i {
    margin-right: 12px;
}

.sidebar-menu a:hover {
    color: #ffffff;
}

/* Active menu item */
.sidebar-menu .active a {
    background-color: #16a085;
    color: #ffffff;
}

/* Scrollbar style */
.left-side.sidebar-offcanvas::-webkit-scrollbar {
    width: 8px;
}

.left-side.sidebar-offcanvas::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
}

.left-side.sidebar-offcanvas::-webkit-scrollbar-track {
    background-color: #ecf0f1;
}
</stye>

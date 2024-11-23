<?php
// Fetch all today's counts and notifications
$today = date("Y-m-d");
$total_count_query = "
    SELECT 
        (SELECT COUNT(*) FROM tblactivity WHERE DATE(date_created) = '$today') +
        (SELECT COUNT(*) FROM tblactivityphoto WHERE DATE(date_created) = '$today') +
        (SELECT COUNT(*) FROM tblblotter WHERE DATE(date_created) = '$today') +
        (SELECT COUNT(*) FROM tblresident WHERE DATE(date_created) = '$today') AS total_count
";
$total_count_result = $con->query($total_count_query)->fetch_assoc();
$total_count = $total_count_result['total_count'] ?? 0;

$notifications_query = "SELECT * FROM tblresident WHERE DATE(date_created) = '$today' ORDER BY id DESC LIMIT 5";
$notifications_result = $con->query($notifications_query);
$notifications = [];
while ($row = $notifications_result->fetch_assoc()) {
    $notifications[] = $row;
}
?>

<!-- Enhanced Notification Bell -->
<nav class="navbar navbar-static-top">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <div style="position: relative;">
                <i class="fa fa-bell" id="notificationBell" style="font-size: 20px; color: black; cursor: pointer;"></i>
                <?php if ($total_count > 0): ?>
                    <div class="round" id="notificationCount">
                        <span><?= $total_count ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </li>
    </ul>
</nav>

<!-- Notification Dropdown -->
<div id="notificationList" style="display: none; position: absolute; top: 50px; right: 10px; width: 300px; background: white; border: 1px solid #ddd; border-radius: 5px; z-index: 1000;">
    <ul style="list-style: none; padding: 0; margin: 0;">
        <?php if (!empty($notifications)): ?>
            <?php foreach ($notifications as $notification): ?>
                <li style="padding: 10px; border-bottom: 1px solid #eee;">
                    <p style="margin: 0; font-size: 14px;">
                        <strong><?= $notification['fname'] . ' ' . $notification['mname'] . ' ' . $notification['lname'] ?></strong><br>
                        Date Move In: <?= $notification['datemove'] ?>
                    </p>
                </li>
            <?php endforeach; ?>
            <li style="padding: 10px; text-align: center;">
                <a href="all_notifications.php" style="font-size: 14px; color: blue;">View All Notifications</a>
            </li>
        <?php else: ?>
            <li style="padding: 10px; text-align: center;">
                <p style="margin: 0; font-size: 14px; color: gray;">No new notifications</p>
            </li>
        <?php endif; ?>
    </ul>
</div>

<script>
    // Toggle Notification Dropdown
    document.getElementById('notificationBell').addEventListener('click', function() {
        const list = document.getElementById('notificationList');
        list.style.display = (list.style.display === 'none' || list.style.display === '') ? 'block' : 'none';
    });

    // Hide notifications when clicking outside
    window.addEventListener('click', function(e) {
        const bell = document.getElementById('notificationBell');
        const list = document.getElementById('notificationList');
        if (!bell.contains(e.target) && !list.contains(e.target)) {
            list.style.display = 'none';
        }
    });
</script>

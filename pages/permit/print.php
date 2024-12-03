<!DOCTYPE html>
<html id="permit">
<head>
    <style>
        @media print {
            .noprint {
                display: none;
            }

            @page {
                size: auto;
                margin: 4mm;
            }

            body {
                margin: 0;
                padding: 0;
                font-size: 14px;
            }

            .logo img {
                max-width: 200px;
                height: auto;
                display: block;
                margin: 0 auto;
            }

            .main-container {
                display: flex;
                justify-content: space-between;
                margin: 20px 0;
            }

            .content {
                border: 2px solid green;
                padding: 20px;
                margin: 20px 0;
                text-align: justify;
            }

            .content p,
            .content h2 {
                margin: 10px 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
        }

        .noprint {
            margin-top: 20px;
        }

        .logo img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .content {
            border: 2px solid green;
            padding: 20px;
            margin: 20px 0;
            text-align: justify;
        }

        .content p,
        .content h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header("Location: ../../login.php");
        exit();
    }

    include "../connection.php";

    // Retrieve user data
    $residentID = $_GET['resident'];
    $businessName = $_GET['permit'];
    $residentQuery = mysqli_query($con, "SELECT * FROM tblresident r 
        LEFT JOIN tblpermit p ON p.residentid = r.id 
        WHERE r.id = '$residentID' AND p.businessName = '$businessName'");

    $resident = mysqli_fetch_array($residentQuery);

    $officialQuery = mysqli_query($con, "SELECT * FROM tblofficial");
    $officials = [];
    while ($row = mysqli_fetch_assoc($officialQuery)) {
        $officials[] = $row;
    }

    $barangayCaptain = array_filter($officials, function ($official) {
        return $official['sPosition'] === "Captain";
    });
    ?>
    <div class="main-container" id="permit">
        <!-- Left Section -->
        <div class="left-section">
            <div class="logo">
                <img src="../../images/madridejos.png" alt="Madridejos Logo">
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <h3>SANGGUNIANG BARANGAY</h3>
                <?php foreach ($officials as $official): ?>
                    <p><?php echo strtoupper($official['completeName']); ?></p>
                    <?php if ($official['sPosition'] === "Captain"): ?>
                        <b>PUNONG BARANGAY</b>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div style="text-align: center; margin-top: 20px;">
                <h4>Republic of the Philippines</h4>
                <h5>Province of Cebu</h5>
                <h5>Municipality of Madridejos</h5>
                <h5>Barangay Tugas</h5>
            </div>
            <div class="logo">
                <img src="../../images/default.png" alt="Barangay Logo">
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <p style="text-align: center; font-size: 20px;"><b>OFFICE OF THE PUNONG BARANGAY</b></p>
        <h2 style="text-align: center;">BARANGAY CLEARANCE FOR BUSINESS PERMIT</h2>
        <?php if ($resident): ?>
            <p>To whom it may concern:</p>
            <p>
                Barangay Clearance is hereby granted to <b><u><?php echo strtoupper($resident['fname'] . ' ' . $resident['mname'] . ' ' . $resident['lname']); ?></u></b>, 
                owner of <b><u><?php echo strtoupper($resident['businessName']); ?></u></b>, 
                located at Barangay Tugas, Madridejos, Cebu, after fully complying with the existing barangay ordinance, rules, and regulations enforced in this barangay.
            </p>
            <p>
                This Clearance is issued upon the request of the above-named person for whatever legal purpose it may serve.
                Issued this <u><?php echo date("jS"); ?></u> day of <u><?php echo date("F, Y"); ?></u> at Barangay Tugas, Madridejos, Cebu, Philippines.
            </p>
            <p style="text-align: right;">
                <?php if (!empty($barangayCaptain)): ?>
                    <b><u><?php echo strtoupper(current($barangayCaptain)['completeName']); ?></u><br>Punong Barangay</b>
                <?php endif; ?>
            </p>
        <?php else: ?>
            <p>No resident data available for the selected permit and resident.</p>
        <?php endif; ?>
    </div>

    <!-- Print Button -->
    <button class="btn btn-primary noprint" id="printButton">Print</button>

    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>
</html>

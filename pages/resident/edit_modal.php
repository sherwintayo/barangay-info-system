<?php
if(isset($row['id'])) {
    echo '<div id="editModal'.$row['id'].'" class="modal fade">';
    
    // Rest of your code...
    
} else {
    echo "No data found for editing.";
}
?>

<form class="form-horizontal" method="post" enctype="multipart/form-data"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Resident Information</h4>
        </div>
        <div class="modal-body">

        <div class="row">
                            <div class="container-fluid">
                                <div class="col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <!--<label class="control-label" >Name:</label><br>-->
                                        <div class="col-sm-4">
                                            <input name="txt_lname" class="form-control input-sm" type="text" placeholder="Lastname" required="" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input name="txt_fname" class="form-control input-sm col-sm-4" type="text" placeholder="Firstname" required="" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input name="txt_mname" class="form-control input-sm col-sm-4" type="text" placeholder="Middlename" required="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label class="control-label">Birthdate:</label>-->
                                        <input name="txt_bdate" class="form-control input-sm input-size" type="date" placeholder="Birthdate" required="" />
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label class="control-label">Age:</label>
                                        <input name="txt_age" class="form-control input-sm input-size" type="number" placeholder="Age"/>
                                    </div> -->


                                    <div class="form-group">
                                        <!-- <label class="control-label">Barangay:</label>-->
                                        <input name="txt_brgy" class="form-control input-sm input-size" type="text" placeholder="Barangay" required="" />
                                    </div>

                                    <div class="form-group">
                                       <!--  <label class="control-label">Household #:</label>-->
                                        <input name="txt_householdnum" class="form-control input-sm input-size" type="number" min="1" placeholder="Household #" required="" />
                                    </div>

                                    <div class="form-group">
                                        <!-- <label class="control-label">Civil Status:</label>-->
                                        <select name="txt_cstatus" class="form-control input-sm input-size">
                                        <option selected="" disabled="" >-Select Status-</option>
                                            <option>Single</option>
                                            <option>Married</option>
                                            <option>Widow</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                         <!--<label class="control-label">Region:</label>-->
                                        <input name="txt_region" class="form-control input-sm input-size" type="text" placeholder="Region" required="" />
                                    </div>
                                    <div class="form-group">
                                         <!--<label class="control-label">Educational Attainment:</label>-->
                                        <select name="ddl_eattain" class="form-control input-sm input-size">
                                            <option>No schooling completed</option>
                                            <option>Elementary</option>
                                            <option>High school, undergrad</option>
                                            <option>High school graduate</option>
                                            <option>College, undergrad</option>
                                            <option>Vocational</option>
                                            <option>Bachelor’s degree</option>
                                            <option>Master’s degree</option>
                                            <option>Doctorate degree</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <!--<label class="control-label">Municipality:</label>-->
                                        <input name="txt_Municipality" class="form-control input-sm input-size" type="text" placeholder="Municipality" required="" />
                                    </div>
                                    <div class="form-group">
                                    <!-- <label class="control-label">Civil Status:</label>-->
                                    <select name="txt_cstatus" class="form-control input-sm input-size">
                                        <option selected="" disabled="">-Select -</option>
                                        <option>PWD</option>
                                        <option>Senior</option>
                                        <option>Pregnant</option>
                                        <option>InActive</option>
                                        <option>Active</option>
                                    </select>
                                </div>

                                    
                                    <div class="form-group">
                                        <label class="control-label">Date Moved In:</label>
                                        <input id="txt_date_of_transfer" name="txt_date_of_transfer" class="form-control input-sm" type="date" placeholder="Date Moved In" required="" />
                                        <span id="length_of_stay"></span> <!-- This span will display the calculated length of stay -->
                                    </div>
                                    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the date moved in from the form
    $dateMovedIn = $_POST["txt_date_of_transfer"];

    // Calculate the difference in months
    $today = date_create(date("Y-m-d")); // Current date
    $movedInDate = date_create($dateMovedIn); // Date moved in
    $interval = date_diff($movedInDate, $today);
    $diffInMonths = $interval->m + ($interval->y * 12);

    // Check if 6 months have passed
    if ($diffInMonths >= 6) {
        // Generate JavaScript code to display alert
        echo "<script>alert('The new resident will now be considered as a citizen of the barangay.');</script>";
    }
}
?>

                                    <div class="form-group">
                                        <!-- <label class="control-label">Username:</label>
                                        <input name="txt_uname" id="username" class="form-control input-sm input-size" type="text" placeholder="Username" required="" />
                                        <label id="user_msg" style="color:#CC0000;" ></label>-->
                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-12">
                                    
                                    <div class="form-group">     
                                         <!--<label class="control-label">Gender:</label>-->
                                        <select name="ddl_gender" class="form-control input-sm" required=""/>
                                            <option selected="" disabled="">-Select Gender-</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                       <!--  <label class="control-label">Birthplace:</label>-->
                                        <input name="txt_bplace" class="form-control input-sm" type="text" placeholder="Birthplace" required="" />
                                    </div> 

                                    <div class="form-group">
                                        <!-- <label class="control-label">Province:</label>-->
                                        <input name="txt_province" class="form-control input-sm" type="text" placeholder="Province" required="" />
                                    </div> 

                                    <div class="form-group">
                                        <!-- <label class="control-label">Purok/Zone #:</label>-->
        
                                        <select name="txt_zone" class="form-control input-sm"  />
                                    <option selected="" disabled="">-- Select Zone/Purok -- </option>
                                    <option value="Rosas"> Rosas</option>
                                    <option value="Bombil"> Bombil</option>
                                    <option value="Santan"> Santan</option>
                                     <option value="Kumintang"> Kumintang</option>
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label class="control-label">Total Household Member:</label>-->
                                        <input name="txt_householdmem" class="form-control input-sm" type="number" min="1" placeholder="Total Household Member" required="" />
                                    </div>

                                    <div class="form-group">
                                        <!-- <label class="control-label">Occupation:</label>-->
                                        <input name="txt_occp" class="form-control input-sm" type="text" placeholder="Occupation" required="" />
                                    </div>
                                    <div class="form-group">
                                         <!--<label class="control-label">Citizenship:</label>-->
                                        <input name="txt_Citizenship" class="form-control input-sm" type="text" placeholder="Citizenship" required="" />
                                    </div>
                                    <div class="form-group">
                                         <!--<label class="control-label">Former Address:</label>-->
                                        <input name="txt_faddress" class="form-control input-sm" type="text" placeholder="Former Address" required="" />
                                    </div>

                                    
                                    <div class="form-group">
                                         <!--<label class="control-label">Password:</label>
                                        <input name="txt_upass" class="form-control input-sm" type="password" placeholder="Password" required="" />-->
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Image:</label>
                                        <input name="txt_image" class="form-control input-sm" type="file" required="" />
                                    </div>



                                </div>

                            </div>
                        </div>
                        
                        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Update"/>
        </div>
    </div>
  </div>
</form>
</div>
           
          
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
$(document).ready(function() {
    // Function to calculate length of stay and send notification 
    function sendNotification(selectedDate) {
        // Convert the selected date string to a Date object
        var dateMovedIn = new Date(selectedDate);
        
        // Get the current date
        var today = new Date();
        
        // Calculate the difference in milliseconds between the current date and the selected date
        var diffInMilliseconds = today - dateMovedIn;
        
        // Calculate the difference in months (approximately)
        var diffInMonths = Math.floor(diffInMilliseconds / (1000 * 60 * 60 * 24 * 30));
        
        // Display the calculated length of stay in months
        $('#length_of_stay').html('Length of stay: ' + diffInMonths + ' months');

        // Check if 6 months have passed
        if (diffInMonths >= 6) {
            // Send notification
            alert("The new resident will now be considered as a citizen of the barangay.");
            // You can replace the alert with an AJAX call to send the notification to the server
        }
    }

    // When the "Add Resident" button is clicked
    $('#btn_add').click(function() {
        // Get the selected date from the input field
        var selectedDate = $('#txt_date_of_transfer').val();
        
        // Check if a date is selected
        if (selectedDate !== '') {
            // Call the function to send notification
            sendNotification(selectedDate);
        } else {
            // If no date is selected, clear the displayed length of stay
            $('#length_of_stay').html('');
        }
    });
});  
</script>

                

        
       
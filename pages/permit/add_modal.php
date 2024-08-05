<!-- ========================= MODAL ======================= -->
            <div id="addModal" class="modal fade">
            <form method="post">
              <div class="modal-dialog modal-sm" style="width:300px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Manage Permit Clearance</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Resident:</label>
                                    <select name="ddl_resident" class="select2 form-control input-sm" style="width:100%;" required=""/>
                                        <option selected="" disabled="">-- Select Resident -- </option>
                                        <?php
                                            $squery = mysqli_query($con,"SELECT id,lname,fname,mname from tblresident");
                                            while ($row = mysqli_fetch_array($squery)){
                                                echo '
                                                    <option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>    
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Business Name:</label>
                                    <input name="txt_busname" class="form-control input-sm" type="text" placeholder="Business Name" required="" />
                                </div>
                                <div class="form-group">
                                    <label>Business Address:</label>
                                    <!-- <input name="txt_busadd" class="form-control input-sm" type="text" placeholder="Business Address" required="" /> -->
                                    <select name="txt_busadd" class="form-control input-sm" required="">
                                        <option selected="" disabled="" value="">-Select Barangay-</option>
                                        <option value="Kangwayan">Kangwayan</option>
                                        <option value="Kodia">Kodia</option>
                                        <option value="Pili">Pili</option>
                                        <option value="Bunakan">Bunakan</option>
                                        <option value="Tabagak">Tabagak</option>
                                        <option value="Maalat">Maalat</option>
                                        <option value="Tarong">Tarong</option>
                                        <option value="Malbago">Malbago</option>
                                        <option value="Mancilang">Mancilang</option>
                                        <option value="Kaongkod">Kaongkod</option>
                                        <option value="San Agustin">San Agustin</option>
                                        <option value="Poblacion">Poblacion</option>
                                        <option value="Tugas">Tugas</option>
                                        <option value="Talangnan">Talangnan</option>
                            </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>OR Number:</label>
                                    <input name="txt_ornum" class="form-control input-sm" type="number" placeholder="OR Number" required="" />
                                </div>
                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input name="txt_amount" class="form-control input-sm" <?php
                                    echo number_format("130",2);
                                    ?>/>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Permit"/>
                    </div>
                </div>
              </div>
              </form>
            </div>

            <script>
    $(document).ready(function() {
    var timeOut = null;
    var loading_html = '<img src="../../img/ajax-loader.gif" style="height: 20px; width: 20px;"/>';

    $('#username').on('input', function() { // Change from keyup to input
        if (timeOut != null)
            clearTimeout(timeOut);
        timeOut = setTimeout(is_available, 500);
        $('#user_msg').html(loading_html);
    });
});

function is_available() {
    var username = $('#username').val();
    $.post("check_username.php", { username: username },
        function(result) {
            console.log(result);
            if (result != 0) {
                $('#user_msg').html('Not Available');
                $('#btn_add').prop('disabled', true); // Updated to jQuery method
            } else {
                $('#user_msg').html('<span style="color:#006600;">Available</span>');
                $('#btn_add').prop('disabled', false); // Updated to jQuery method
            }
        });
}

    </script>

<!-- ========================= MODAL ======================= -->
            <div id="addModal" class="modal fade">
            <form method="post">
              <div class="modal-dialog modal-sm" style="width:300px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Manage Clearance</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label>Resident:</label>
                                    <select name="ddl_resident" class="select2 form-control input-sm" style="width:100%" required="" />
                                        <option selected="" disabled="">-- Select Resident -- </option>
                                    <?php
                                    // Ensure $zone_barangay is defined and properly sanitized
                                    $zone_barangay = mysqli_real_escape_string($con, $zone_barangay); // Prevent SQL injection
                                    
                                    // Modify the query to filter by Barangay using $zone_barangay
                                    $squery = mysqli_query($con, "
                                        SELECT r.id, r.lname, r.fname, r.mname
                                        FROM tblresident r
                                        WHERE (
                                            (r.id NOT IN (SELECT personToComplain FROM tblblotter))
                                            OR
                                            (r.id IN (SELECT personToComplain FROM tblblotter WHERE sStatus = 'Solved'))
                                        )
                                        AND r.lengthofstay >= 6
                                        AND r.barangay = '$zone_barangay'"); // Filter by Barangay
                                    
                                    // Check if there are any results
                                    if (mysqli_num_rows($squery) > 0) {
                                        while ($row = mysqli_fetch_array($squery)) {
                                            echo '
                                                <option value="' . $row['id'] . '">' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</option>
                                            ';
                                        }
                                    } else {
                                        // If no results found, you can show a message or handle it differently
                                        echo '<option>No residents found in this Barangay.</option>';
                                    }
                                    ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type of Clearance:</label>
                                    <select name="txt_Clearance" class="form-control input-sm",  required=""/ >
                                        <option selected="" disabled="">-- Select Type of Clearance -- </option>
                                         <option value="Employment">Employment</option>
                                         <option value="Police Clearance">Police Clearance</option>
                                        <option value="Loan">Loan</option>
                                        <option value="Barangay Indigency">Barangay Indigency</option>

                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>OR Number:</label>
                                    <input name="txt_ornum" class="form-control input-sm" type="number" placeholder="OR Number" required />
                                    <p>Note:(Indigency has no OR Number)</p>
                                </div>
                                <div class="form-group">
                                    <label>Amount:</label>
                                    <select name="txt_amount" class="form-control input-sm"  />
                                    <option selected="" disabled="">-- Select Amount -- </option>
                                    <option value="80">80</option>
                                    <option value="130">130</option>
                                    <option value="0">0</option>
                                    </select>
                                    <p>Note:(Indigency is Free)</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Clearance"/>
                    </div>
                </div>
              </div>
              </form>
            </div>

<!-- ========================= MODAL ======================= -->
            <div id="addModal" class="modal fade">
            <form class="form-horizontal" method="post">
              <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Manage Blotter</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-2"  style="width:110px;">
                                        <label class="control-label">Complainant:</label>
                                    </div>  
                                    <div class="col-sm-4">
                                        <select name="txt_cname" class="form-control input-sm select2" style="width:100%" required=""/>
                                            <option disabled selected>-- Select Complainant --</option>
                                            <?php
                                            if ($isZoneLeader) {
                                                $qc = mysqli_query($con,"SELECT * from tblresident WHERE barangay = '$zone_barangay'");
                                            }else{
                                                $qc = mysqli_query($con,"SELECT * from tblresident");
                                            }
                                                while($rowc = mysqli_fetch_array($qc)){
                                                    echo '
                                                    <option>'.$rowc['lname'].', '.$rowc['fname'].' '.$rowc['mname'].'</option>
                                                    ';
                                                }
                                            ?>   
                                        </select>
                                    </div> 

                                    <div class="col-sm-2"  style="width:110px;">
                                        <label class="control-label">Age:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input name="txt_cage" class="form-control input-sm" type="number" placeholder="Complainant Age" required="" />
                                    </div> 
                                </div>
                           
                                <div class="form-group">
                                    <div class="col-md-2"  style="width:110px;">
                                        <label class="control-label">Address:</label>
                                    </div>  
                                    <div class="col-sm-4" >
                                        <input name="txt_cadd" class="form-control input-sm" type="text" placeholder="Complainant Address" required="" />
                                    </div> 

                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Contact #:</label>
                                    </div>  
                                    <div class="col-sm-4" >
                                        <input name="txt_ccontact" class="form-control input-sm" type="tel" placeholder="Contact #" maxlength="11" minlength="11" pattern="[0-9]{11}" required="" />
                                    </div> 

                                </div> 

                                <div class="form-group">
                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Complainee:</label>
                                    </div>  
                                    <div class="col-sm-4">
                                        <select name="txt_pname" class="form-control input-sm select2" style="width:100%" required=""/>
                                            <option disabled selected>-- Select Complainee --</option>
                                            <?php
                                                if ($isZoneLeader) {
                                                    $qp = mysqli_query($con,"SELECT * from tblresident WHERE barangay = '$zone_barangay'");
                                                }else{
                                                    $qp = mysqli_query($con,"SELECT * from tblresident");
                                                }
                                                while($rowp = mysqli_fetch_array($qp)){
                                                    echo '
                                                    <option value="'.$rowp['id'].'">'.$rowp['lname'].', '.$rowp['fname'].' '.$rowp['mname'].'</option>
                                                    ';
                                                }
                                            ?>   
                                        </select>
                                    </div>

                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Age:</label>
                                    </div>
                                    <div class="col-sm-4" >
                                        <input name="txt_page" class="form-control input-sm" type="number" placeholder="Complainee Age" required="" />
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Address:</label>
                                    </div>  
                                    <div class="col-sm-4" >
                                        <input name="txt_padd" class="form-control input-sm" type="text" placeholder="Complainee Address" required="" />
                                    </div> 

                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Contact #:</label>
                                    </div>  
                                    <div class="col-sm-4" >
                                        <input name="txt_pcontact" class="form-control input-sm" type="tel" maxlength="11" minlength="11" pattern="[0-9]{11}" placeholder="Contact #" required="" />
                                    </div> 

                                </div> 

                                <div class="form-group">
                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Complaint:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input name="txt_complaint" class="form-control input-sm" type="text" placeholder="Complaint" required="" />
                                    </div> 
                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Incidence:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input name="txt_location" class="form-control input-sm" type="text" placeholder="Location of Incidence" required="" />
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Status:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="ddl_stat" class="form-control input-sm" required="">
                                            <option >Solved</option>
                                            <option >Unsolved</option>
                                            <option >Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2" style="width:110px;">
                                        <label class="control-label">Person Handling this Case:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="ddl_lupon" class="form-control input-sm" required="">
                                            <option >Serafin Descartin</option>
                                            <option >Felisa Chavez</option>
                                            <option >Angelita Aropo</option>
                                            <option >Victoria Golisao</option>
                                            <option >Anecito Bacolod</option>
                                            <option >Ponciano Balili</option>
                                             <option >Elias Medallo</option>
                                        </select>
                                    </div><!--/lupon-->
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Blotter"/>
                    </div>
                </div>
              </div>
              </form>
            </div>

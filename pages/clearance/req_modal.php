<!-- ========================= MODAL ======================= -->
            <div id="reqModal" class="modal fade">
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
                                    <label>Type of Clearance:</label>
                                    <select name="txt_Clearance" class="form-control input-sm" required=""/>
                                        <option selected="" disabled="">-- Select Type of Clearance -- </option>
                                         <option value="Employment">Employment</option>
                                         <option value="Police Clearance">Police Clearance</option>
                                        <option value="Loan">Loan</option>
                                        <option value="Barangay Indigency">Barangay Indigency</option>
                                    </select>  
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_req" value="Request Clearance"/>
                    </div>
                </div>
              </div>
              </form>
            </div>
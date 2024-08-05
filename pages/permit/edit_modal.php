<div id="editModal<?= $row['pid'] ?>" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Permit</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="<?= $row['pid'] ?>" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Resident: </label>
                    <input class="form-control input-sm" type="text" value="<?= $row['residentname'] ?>" readonly/>
                </div>
                <div class="form-group">
                    <label>Business Name: </label>
                    <input name="txt_edit_busname" class="form-control input-sm" type="text" value="<?= $row['businessName'] ?>" required=""/>
                </div>
                <div class="form-group">
                    <label>Business Address : </label>
                    <!-- <input name="txt_edit_busadd" class="form-control input-sm" type="text" value="'.$row['businessAddress'].'" required=""/> -->

                    <select name="txt_edit_busadd" class="form-control input-sm" required="">
                        <option selected="" disabled="" value="">-Select Barangay-</option>
                        <option value="Kangwayan" <?= $row['businessAddress'] == 'Kangwayan' ? 'selected' : '' ?>>Kangwayan</option>
                        <option value="Kodia" <?= $row['businessAddress'] == 'Kodia' ? 'selected' : '' ?>>Kodia</option>
                        <option value="Pili" <?= $row['businessAddress'] == 'Pili' ? 'selected' : '' ?>>Pili</option>
                        <option value="Bunakan" <?= $row['businessAddress'] == 'Bunakan' ? 'selected' : '' ?>>Bunakan</option>
                        <option value="Tabagak" <?= $row['businessAddress'] == 'Tabagak' ? 'selected' : '' ?>>Tabagak</option>
                        <option value="Maalat" <?= $row['businessAddress'] == 'Maalat' ? 'selected' : '' ?>>Maalat</option>
                        <option value="Maalat" <?= $row['businessAddress'] == 'Maalat' ? 'selected' : '' ?>>Tarong</option>
                        <option value="Malbago" <?= $row['businessAddress'] == 'Malbago' ? 'selected' : '' ?>>Malbago</option>
                        <option value="Mancilang" <?= $row['businessAddress'] == 'Mancilang' ? 'selected' : '' ?>>Mancilang</option>
                        <option value="Kaongkod" <?= $row['businessAddress'] == 'Kaongkod' ? 'selected' : '' ?>>Kaongkod</option>
                        <option value="San Agustin" <?= $row['businessAddress'] == 'San Agustin' ? 'selected' : '' ?>>San Agustin</option>
                        <option value="Poblacion" <?= $row['businessAddress'] == 'Poblacion' ? 'selected' : '' ?>>Poblacion</option>
                        <option value="Tugas" <?= $row['businessAddress'] == 'Tugas' ? 'selected' : '' ?>>Tugas</option>
                        <option value="Talangnan" <?= $row['businessAddress'] == 'Talangnan' ? 'selected' : '' ?>>Talangnan</option>
                    </select>

                </div>
                
                <div class="form-group">
                    <label>OR Number : </label>
                    <input name="txt_edit_ornum" class="form-control input-sm" type="text" value="<?= $row['orNo'] ?>" />
                </div>
                <div class="form-group">
                    <label>Amount : </label>
                    <input name="txt_edit_amount" class="form-control input-sm" value="<?php
                                    echo number_format($row['samount']);
                                    ?> " />
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

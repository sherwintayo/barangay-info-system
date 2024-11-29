<?php 
echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Course Info</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Position: </label>
                    <input class="form-control input-sm" type="text" value="'.$row['sPosition'].'" readonly/>
                </div>
                <div class="form-group">
                    <label>Name: <span style="color:gray; font-size: 10px;">(Lastname, Firstname Middlename)</span></label>
                    <input name="txt_edit_cname" class="form-control input-sm" type="text" value="'.$row['completeName'].'"/>
                </div>
                <div class="form-group">
                    <label>Contact #: </label>
                    <input name="txt_edit_contact" class="form-control input-sm" type="text" value="'.$row['pcontact'].'" />
                </div>
                <div class="form-group">
                    <label>Address: </label>
                    <input name="txt_edit_address" class="form-control input-sm" type="text" value="'.$row['paddress'].'" />
                </div>';

if ($_SESSION['role'] == 'Administrator') {
    echo '<div class="form-group">
            <label>Barangay: </label>
            <select name="ddl_edit_barangay" class="form-control input-sm">
                <option selected="" disabled="">-- Select Barangay --</option>
                <option value="Poblacion" '.($row['barangay'] == 'Poblacion' ? 'selected' : '').'>Poblacion</option>
                <option value="Mancilang" '.($row['barangay'] == 'Mancilang' ? 'selected' : '').'>Mancilang</option>
                <option value="Talangnan" '.($row['barangay'] == 'Talangnan' ? 'selected' : '').'>Talangnan</option>
                <option value="Malbago" '.($row['barangay'] == 'Malbago' ? 'selected' : '').'>Malbago</option>
                <option value="Tarong" '.($row['barangay'] == 'Tarong' ? 'selected' : '').'>Tarong</option>
                <option value="Tugas" '.($row['barangay'] == 'Tugas' ? 'selected' : '').'>Tugas</option>
                <option value="Maalat" '.($row['barangay'] == 'Maalat' ? 'selected' : '').'>Maalat</option>
                <option value="Pili" '.($row['barangay'] == 'Pili' ? 'selected' : '').'>Pili</option>
                <option value="Kaongkod" '.($row['barangay'] == 'Kaongkod' ? 'selected' : '').'>Kaongkod</option>
                <option value="Bunakan" '.($row['barangay'] == 'Bunakan' ? 'selected' : '').'>Bunakan</option>
                <option value="Tabagak" '.($row['barangay'] == 'Tabagak' ? 'selected' : '').'>Tabagak</option>
                <option value="Kodia" '.($row['barangay'] == 'Kodia' ? 'selected' : '').'>Kodia</option>
                <option value="Kangwayan" '.($row['barangay'] == 'Kangwayan' ? 'selected' : '').'>Kangwayan</option>
                <option value="San Agustin" '.($row['barangay'] == 'San Agustin' ? 'selected' : '').'>San Agustin</option>
            </select>
          </div>';
}

echo '      <div class="form-group">
                    <label>Start Term: </label>
                    <input name="txt_edit_sterm" class="form-control input-sm" type="date" value="'.$row['termStart'].'" />
                </div>
                <div class="form-group">
                    <label>End Term: </label>
                    <input name="txt_edit_eterm" class="form-control input-sm" type="date" value="'.$row['termEnd'].'" />
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';
?>

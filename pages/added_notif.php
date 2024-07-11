<?php if(isset($_SESSION['added'])){
    echo '<script>$(document).ready(function (){save_success();});</script>';
    unset($_SESSION['added']);
    } ?>
<div class="alert alert-success alert-autocloseable-add" style=" position: fixed; top: 7em; right: 35em; z-index: 9999; display: none;">
     Successfully Added !
</div>
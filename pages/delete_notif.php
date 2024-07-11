<?php if(isset($_SESSION['delete'])){
    echo '<script>$(document).ready(function (){deleted();});</script>';
    unset($_SESSION['delete']);
    } ?>
<div class="alert alert-danger alert-autocloseable-danger" style=" position: fixed; top: 7em; right: 35em; z-index: 9999; display: none;">
     Deleted Successfully !
</div>
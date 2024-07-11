<?php if(isset($_SESSION['restore'])){
    echo '<script>$(document).ready(function (){restore();});</script>';
    unset($_SESSION['restore']);
    } ?>
<div class="alert alert-danger alert-autocloseable-danger" style=" position: fixed; top: 7em; right: 35em; z-index: 9999; display: none;">
     Restore Successfully !
</div>
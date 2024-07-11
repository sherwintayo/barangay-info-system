<?php
   define('HOST','localhost');
   define('PWD','');
   define('USERNAME','root');
   define('DB','db_barangay');
   
   $connection = mysqli_connect(HOST,USERNAME,PWD,DB);
   if($con){
       return $con;
   }else{
       echo "Connect problem".mysqli_connect_error();
   }

?>
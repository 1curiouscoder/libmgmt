<?php

/* Getting file name */
$filename = $_FILES['file']['name'];

/* Location */
$location = $filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */

   /* Upload file */
   
      echo $location;
   
?>
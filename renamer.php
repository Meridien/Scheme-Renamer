<?php

$new_filename = $_GET["new_filename"];


include('old_filename.php');

if($new_filename == ""){$new_filename="New Filename";}

$file_info = new SplFileInfo($old_filename);
$file_ext = $file_info->getExtension();

//Handle [orig] - uses the whole old filename
$new_filename = str_replace("[orig]",$old_filename,$new_filename);

//Handle [time] - uses current time
$time_stamp = date('Y-m-d_His',time());
$new_filename = str_replace("[time]",$time_stamp,$new_filename);

//Handle [shuttime] - for organising images using the exif shutter time
$exif = exif_read_data("res/".$old_filename, 0, true);
$shutter_time = strtotime($exif["EXIF"]["DateTimeOriginal"]);
$shutter_time = date('Y-m-d_His',$shutter_time);
$new_filename = str_replace("[shuttime]",$shutter_time,$new_filename);

//Handle [modtime] - uses the file modified time attribute
$modified_time = filemtime("res/".$old_filename);
$modified_time = date('Y-m-d_His',$modified_time);
$new_filename = str_replace("[modtime]",$modified_time,$new_filename);

//Handle [ext] - uses file extension
$new_filename = str_replace("[ext]",".".$file_ext,$new_filename);

//Remove 2 x File Extensions
$new_filename = str_replace(".".$file_ext.".".$file_ext,".".$file_ext,$new_filename);

//Save New Filename
$fh = fopen('new_filename.php', 'w');
fwrite($fh, '<?php $new_filename="'.$new_filename.'";?>');
fclose($fh);

if($old_filename == ""){
    
}else{
    if( file_exists("out/".$new_filename) ){
        $new_filename = "(".uniqid().")".$new_filename;
    }
    
    rename("res/".$old_filename, "out/".$new_filename);
}



?>
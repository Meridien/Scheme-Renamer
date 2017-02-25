<?php

$filename = $_GET["filename"];

if( file_exists("out/".$filename) ){
    rename("out/".$filename, "res/".$filename);
}



?>
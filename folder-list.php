<div style="text-align:left;">
<?php
$dir    = getcwd()."/res";
$files_list = scandir($dir);
$first_filename = "";
foreach($files_list as $file){
    
    if(strlen($file)>3){
        if($first_filename==""){$first_filename=$file;}
        ?><a href="javascript:loadFile('<?php echo $file; ?>');"><?php echo $file; ?></a><br/><?php
    }
}
?>
</div>
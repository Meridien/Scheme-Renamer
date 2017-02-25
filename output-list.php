<div style="text-align:left;">
<?php
$dir    = getcwd()."/out";
$files_list = scandir($dir);
foreach($files_list as $file){
    
    if(strlen($file)>3){
        ?><a href="javascript:reLoadFile('<?php echo $file; ?>');"><?php echo $file; ?></a><br/><?php
    }
    
    
    
}
?>
</div>
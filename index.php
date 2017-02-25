<?php


?>
<html>
    <head>
        <title>Scheme Renamer</title>
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
        <style type="text/css">
            
            *{
                font-family: exo, helvetica, arial narrow, arial, sans-serif;
            }
            
            body{
                margin: 0px;
            }
            
            iframe{
                border: 0px;
                margin: 0px;
                width: 100%;
                padding: 0px;
            }
            
            .folder-selector {
                width:100%;
                display: block;
                height: 30px;
            }
            
            .naming-scheme {
                width:100%;
                display: block;
                height: auto;
                background: #b7b7b7;
                padding-top: 3px;
                padding-bottom: 3px;
            }
            
            .folder-list{
                background: #e1e1e1;
                font-size: 0.7em;
                line-height: 1.6em;
                padding-bottom: 20px;
                height: 95%;
                overflow: hidden;
            }
            
            .file-display{
                background: #b7b7b7;
                font-size: 0.7em;
                line-height: 1.6em;
                padding-bottom: 20px;
                height: 95%;
                overflow: hidden;
            }
            
            form.scheme-selector{
                text-align: center;
                margin-bottom: 3px;
            }
            
                form.scheme-selector input{
                    width:100px;
                }
            
        </style>
        <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>-->
        <script type="text/javascript" src="/assets/js/jquery.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            
            function loadFile(file_name){
                document.getElementById("file-display").contentWindow.location.href="/file-display.php?filename="+file_name;
            }
            
            function reLoadFile(file_name){
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("demo").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("GET", "/reloader.php?filename="+file_name, true);
                xhttp.send();
                
                setTimeout(function(){window.location.reload();}, 500);
                
                //document.getElementById("file-display").contentWindow.location.href="/file-display.php?filename="+file_name;
            }
            
            
            function renameFile(){
                var tfield1 = document.getElementById('tfield1').value;
                var tfield2 = document.getElementById('tfield2').value;
                var tfield3 = document.getElementById('tfield3').value;
                var tfield4 = document.getElementById('tfield4').value;
                var tfield5 = document.getElementById('tfield5').value;
                var file_ext = document.getElementById('file_ext').value;
                var last_selected = document.getElementById('last_selected').value;
                
                var filename_full = tfield1+tfield2+tfield3+tfield4+tfield5+file_ext;
                
                //alert(filename_full);
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("demo").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("GET", "/renamer.php?new_filename="+filename_full, true);
                xhttp.send();
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("demo").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("GET", "/write-scheme.php?tfield1="+tfield1+"&tfield2="+tfield2+"&tfield3="+tfield3+"&tfield4="+tfield4+"&tfield5="+tfield5+"&file_ext="+file_ext+"&last_selected="+last_selected, true);
                xhttp.send();
                
                setTimeout(function(){window.location.reload();}, 700);
                
                
                
            }
            
            function ignoreFile(){
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("demo").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("GET", "/renamer.php?new_filename=[orig]", true);
                xhttp.send();
                setTimeout(function(){window.location.reload();}, 100);
            }
            
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12 naming-scheme"><?php include("naming-scheme.php");?></div>
            </div>
            <div class="row">
                <!--<div class="folder-selector"><?php include("folder-selector.php");?></div>-->
                <div class="col-md-4 col-xs-12 folder-list">
                
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Queue
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <?php include("folder-list.php");?>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Output
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                        <?php include("output-list.php");?>
                        </div>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-8 col-xs-12 file-display">
                    <iframe id="file-display" class="file-display" src="/file-display.php?filename=<?php echo $first_filename; ?>"></iframe>
                </div>
            </div>
        <script>
            var preselect = document.getElementById('<?php echo $last_selected;?>');
                preselect.focus();
                preselect.select();
        </script>
        </div>
    </body>
</html>
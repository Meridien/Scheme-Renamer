<html>
<head>
<style>
    body{
        background: #cfcfcf;
    }
</style>
</head>
<body id="body">
<div class="main" id="main">
    
<?php

    require_once('components/formatXmlString.php');


    
    $filename = "";
    
    if(empty($_GET["filename"])){
        
    }else{
        $filename = $_GET["filename"];
    
    $file_info = new SplFileInfo($filename);
    $file_ext = $file_info->getExtension();
    
    switch($file_ext){
        
        case "pdf":
        case "PDF":
            {
                ?><embed src="/res/<?php echo $filename; ?>" width=100% height=100% type='application/pdf' id="display"><?php
            }
        break;
        case "txt":
		case "php":
		case "js":
		case "css":
		case "html":
		case "htm":
		case "xml":
            {
                $fh = fopen('res/'.$filename, 'rb');
                $text = fread($fh, filesize('res/'.$filename));
                fclose($fh);
                
                if($file_ext == "xml"){
                    $text_xml_obj = new SimpleXMLElement($text);
                    $text = formatXmlString($text_xml_obj->asXML());
                }
                
                ?><textarea style="width:100%;height:100%;" id="display"><?php echo $text; ?></textarea><?php
            }
        break;
        case "gpx":
            {
                $fh = fopen('res/'.$filename, 'rb');
                $text = fread($fh, filesize('res/'.$filename));
                fclose($fh);
                
                $text_xml_obj = new SimpleXMLElement($text);
                $text = formatXmlString($text_xml_obj->asXML());
                
                ?><textarea style="width:100%;" rows=4 id="display"><?php echo $text; ?></textarea>
                
                <?php $map_file_url = '/res/'.$filename; ?>
                <div style="width:100%; height:100%" id="map"></div>
                <link rel="stylesheet" href="/assets/js/leaflet/leaflet.css" />
                <script src="/assets/js/leaflet/leaflet.js"></script>
                <script src="/assets/js/leaflet/plugins/layer/vector/GPX.js"></script>
                <script type='text/javascript'>
                var map = new L.Map('map', {center: new L.LatLng(-27, 153), zoom: 11});
                var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                var track = new L.GPX("<?php echo $map_file_url; ?>", {async: true});
                track.on("loaded", function(e) { map.fitBounds(e.target.getBounds()); });
                map.addLayer(track);
                map.addLayer(osm);
                map.addControl(new L.Control.Layers({}, {'Track':track}));
                </script>
                
                <?php
            }
        break;
        case "kml":
            {
                $fh = fopen('res/'.$filename, 'rb');
                $text = fread($fh, filesize('res/'.$filename));
                fclose($fh);
                
                $text_xml_obj = new SimpleXMLElement($text);
                $text = formatXmlString($text_xml_obj->asXML());
                
                ?><textarea style="width:100%;" rows=4 id="display"><?php echo $text; ?></textarea>
                
                <?php $map_file_url = '/res/'.$filename; ?>
                <div style="width:100%; height:100%" id="map"></div>
                <link rel="stylesheet" href="/assets/js/leaflet/leaflet.css" />
                <script src="/assets/js/leaflet/leaflet.js"></script>
                <script src="/assets/js/leaflet/plugins/layer/vector/KML.js"></script>
                <script type='text/javascript'>
                var map = new L.Map('map', {center: new L.LatLng(-27, 153), zoom: 11});
                var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                var track = new L.KML("<?php echo $map_file_url; ?>", {async: true});
                track.on("loaded", function(e) { map.fitBounds(e.target.getBounds()); });
                map.addLayer(track);
                map.addLayer(osm);
                map.addControl(new L.Control.Layers({}, {'Track':track}));
                </script>
                
                <?php
            }
        break;
        case "webm":
        case "mp4":
        case "MP4":
        case "avi":
		case "AVI":
        case "mov":
        case "MOV":
            {
                ?><video src="/res/<?php echo $filename; ?>" loop="" controls="" style="position: static; pointer-events: inherit; display: inline;"  id="display">Your browser does not support HTML5 video.</video><?php
            }
        break;
        case "jpg":
        case "jpeg":
        case "png":
        case "gif":
        default:
            {
                ?><img id="display" src="/res/<?php echo $filename; ?>" /><br/><?php echo $filename;
				
				switch($file_ext){
					case "jpg":
					case "jpeg":
					case "JPG":
					case "JPeg":
						{
							$exif = exif_read_data("res/".$filename, 0, true);
							$shuttertime = strtotime($exif["EXIF"]["DateTimeOriginal"]);
							$shuttertime = date('Y-m-d_His',$shuttertime);
							echo "<br/>\n".$shuttertime;
						}
					break;
					default:{
					}
				}
            }
    }
    
?>



<?php } ?>
<?php

$fh = fopen('old_filename.php', 'w');
fwrite($fh, '<?php $old_filename="'.$filename.'";?>');
fclose($fh);


?>
</div>
<script>
    
    function resizeDisplay(){
        var divheight = document.getElementById('body').clientHeight;
        var divwidth = document.getElementById('body').clientWidth;
        
        document.getElementById('display').style.maxHeight=(divheight-20);
        document.getElementById('display').style.maxWidth=(divwidth-20);
    }
    
    window.onresize = resizeDisplay();
    
    resizeDisplay();
    
    
</script>
</body>
</html>
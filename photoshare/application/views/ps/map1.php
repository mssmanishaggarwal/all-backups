<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.11&sensor=false" type="text/javascript"></script>
<?php
/*
$dir = base_url()."upload";


function readGPSinfoEXIF($image_full_name)
{
   $exif=exif_read_data($image_full_name, 0, true);
     if(!$exif || $exif['GPS']['GPSLatitude'] == '') {
       return false;
    } else {
    $lat_ref = $exif['GPS']['GPSLatitudeRef'];
    $lat = $exif['GPS']['GPSLatitude'];
    list($num, $dec) = explode('/', $lat[0]);
    $lat_s = $num / $dec;
    list($num, $dec) = explode('/', $lat[1]);
    $lat_m = $num / $dec;
    list($num, $dec) = explode('/', $lat[2]);
    $lat_v = $num / $dec;

    $lon_ref = $exif['GPS']['GPSLongitudeRef'];
    $lon = $exif['GPS']['GPSLongitude'];
    list($num, $dec) = explode('/', $lon[0]);
    $lon_s = $num / $dec;
    list($num, $dec) = explode('/', $lon[1]);
    $lon_m = $num / $dec;
    list($num, $dec) = explode('/', $lon[2]);
    $lon_v = $num / $dec;

    $gps_int = array($lat_s + $lat_m / 60.0 + $lat_v / 3600.0, $lon_s
            + $lon_m / 60.0 + $lon_v / 3600.0);
    return $gps_int;
    }
}


         function dirImages($dir)
         {
             $d = dir($dir);
             while (false!== ($file = $d->read()))
             {
             $extension = substr($file, strrpos($file, '.'));
             if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif"                                        
               |$extension == ".png")
     $images[$file] = $file;
    }
    $d->close();        
    return $images;
}


$array = dirImages(base_url()."upload");
$counter = 0;

foreach ($array as $key => $image)
{
    echo "<br />";
    $counter++;
    echo $counter;
    echo "<br />";
    $image_full_name = $dir."/".$key;
    echo $image_full_name;
    $results = readGPSinfoEXIF($image_full_name);
    $latitude = $results[0];
    echo $latitude;
            echo "<br />";
    $longitude = $results[1];
    echo $longitude;
    echo "<br />";   
}*/
 $exif = exif_read_data(base_url().'upload/test13.jpg',0,true);
/*echo '<pre>';
print_r($exif );
echo '</pre>';*/
$longitude = getGps($exif['GPS']["GPSLongitude"], $exif['GPS']['GPSLongitudeRef']);
$latitude = getGps($exif['GPS']["GPSLatitude"], $exif['GPS']['GPSLatitudeRef']);
//echo $longitude.'</br>'.$latitude ; 
function getGps($exifCoord, $hemi) {

    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

}

function gps2Num($coordPart) {

    $parts = explode('/', $coordPart);

    if (count($parts) <= 0)
        return 0;

    if (count($parts) == 1)
        return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);
}
?>
<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
<?php

$im= $this->db->query("SELECT * FROM images");
$k=$im->result_array();
 foreach($im->result_array() as $row){?><?php echo $row['latitude'].'<br>';?>
<?php } ?>
<script>

function initialize(){
	<?php $count=1;foreach($im->result_array() as $row){?>
	        var myCenter=new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>);
            var marker;
            var mapProp_<?php echo $count?> = {
					  center:myCenter,
					  zoom:5,
					  mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp_<?php echo $count?>);
			var image = new google.maps.MarkerImage('<?php echo base_url().'upload/'.$row['image_name'];?>');
			image.size = new google.maps.Size( 75, 75 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 75, 75 );
			marker=new google.maps.Marker({
			  position:myCenter,
			  animation:google.maps.Animation.BOUNCE,
			  icon:image,
			  });
			  
		<?php $count++;} ?>	
							
							/*infowindow = new google.maps.InfoWindow({
                                content: 'Hello, World!!'
                            });
							infowindow.open(map, marker);*/	
							
                       
marker.setMap(map);
/*-------------------*/

<?php /*?>var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
			var lat = $(this).attr( '<?php echo $latitude;?>' );
			var lon = $(this).attr( '<?php echo $longitude;?>' );
			var src =$(this).attr( '<?php echo base_url().'upload/test13.jpg';?>' );
			
			//var id = $(this).parent( 'a' ).attr( 'id' );
			var myLatLng = new google.maps.LatLng(lat,lon);
			 var beachMarker = new google.maps.Marker({
                                          position: myLatLng,
                                          map: map,
                                          icon: src
  });
beachMarker.setMap(map);<?php */?>
/*-------------------*/
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>
<body>
<div id="googleMap" style="width:1300px;height:680px;"></div>
</body>
</html>
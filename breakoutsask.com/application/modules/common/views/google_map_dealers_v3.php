<?php
$zoom = '5';
//$id  	= $this->input->get('id',TRUE);
$gKey = "ABQIAAAAdjS4lmLMlTtlzHFQWUlmPBSvQE6eLkRCVgx78PCg1bXuccIYSxTWErwPOIY_eciC0ESC921WM2vZTg";
$j=0;
$str = array("\n","\r");
//$default_lat = $this->data['site_settings']->latitude;
//$default_lng = $this->data['site_settings']->longitude;
if(empty($default_lat)){$default_lat='52.160396';}
if(empty($default_lng)){$default_lng='-106.656611';}
?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Contact Location</title>
	<style type="text/css">
body {color:#000000;font:13px/17px "Lucida Sans Unicode", Arial, Helvetica, sans-serif;}
#map{margin:0px;bottom:0;left:0;right:0;top:0;}
.hook{
	margin:3px;
	padding-bottom:7px;
	font-size:14px;
	border-radius: 15px;
  padding-left:10px;
	}
.noscrollbar {
line-height:1.35;
overflow:hidden;
white-space:nowrap;
}
</style>
<?php
    $map_marker = "";
    if(!empty($contact->map_marker) && is_file(file_upload_absolute_path()."contact_photo/thumb_".$contact->map_marker))
    {
            $map_marker = file_upload_base_url()."contact_photo/thumb_".$contact->map_marker;

    } 
?>
 
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|FF0000|FFFFFF',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(<?php echo $default_lat;?>, <?php echo $default_lng;?>),
        zoom: <?php echo $zoom;?>,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP file
      downloadUrl("<?php echo site_url("common/google_map_xml/");?>", function(data) {//alert(data.responseXML);
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");		  
		  var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<div class='hook noscrollbar'>" + address+"</div>";
		  var icon = customIcons[type] || {};          
          var marker = new google.maps.Marker({
            map: map,
            position: point,
			icon: '<?php echo $map_marker; ?>',
      		shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
     
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);		
        infoWindow.open(map, marker);
		divhook();
      });	
	  google.maps.event.addListener(infoWindow, 'domready', function() {
    var l = $('.hook').parent().parent().parent().siblings();
    for (var i = 0; i < l.length; i++) {
        if($(l[i]).css('z-index') == 'auto') {
            $(l[i]).css('border-radius', '16px 16px 16px 16px');
            $(l[i]).css('border', '2px solid #CCCCCC');
        }
    }
}); 
    }
	

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //.parent().prev()]]>
function divhook(){
	$('.hook').parent().parent().parent().css('border-radius', '16px 16px 16px 16px');
}

		
  </script>
  </head>

  <body onLoad="load()">
    <div id="map" style="width: 100%; height: 251px"></div>
	
  </body>

</html>

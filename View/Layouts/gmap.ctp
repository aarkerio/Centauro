<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
     <title>MonoNeurona::Google Maps</title>
<style type="text/css"> 
     body {
 background: #fff url(/img/imgusers/aarkerio_1985.jpg) bottom right no-repeat;
 margin: 0px;
 padding: 0px;
 font-size: 10pt; 
 font-family: Verdana, Arial;
 min-width:900px;
 }
</style>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<script type="text/javascript" src="http://www.google.com/jsapi"></script> 

 <!-- script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAjPKkDYTVDZGDWlW2yrngQRS683khtCNerCX0A8OGSN-Hv50GHRRSNxYQrB8Gx4ciUuqyy6DNkow08g"
            type="text/javascript"></script -->

<script type="text/javascript">
//<![CDATA[
google.load("maps", "3",  {other_params:"sensor=false"});
google.load("jquery", "1.3.2");
 
function initialize() {
    var myLatlng = new google.maps.LatLng(19.43576, -99.14466);
    var myOptions = {
    zoom: 12,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
    // For more information on doing XMLHR with jQuery, see these resources:
    // http://net.tutsplus.com/tutorials/javascript-ajax/use-jquery-to-retrieve-data-from-an-xml-file/
    // http://marcgrabanski.com/article/jquery-makes-parsing-xml-easy
    jQuery.get("/markers/display", {}, function(data) {
            jQuery(data).find("marker").each(function() {
                    var marker  = jQuery(this);
                    var latlng  = new google.maps.LatLng(parseFloat(marker.attr("lat")),
                                                        parseFloat(marker.attr("lng")));
                    var name    = marker.attr('name');
                    var address = marker.attr('address');
                    var user    = marker.attr('user');
                    //alert(name);
                    var marker  = new google.maps.Marker({position: latlng, map: map});
                    
                    // create the tooltip and its text
                    var infoWindow = new google.maps.InfoWindow();
                    var html='<b>'+name+'</b><br />'+address+' <br />Recommended by:<b>'+ user+'</b>';
                    // add a listener to open the tooltip when a user clicks on one of the markers
                    google.maps.event.addListener(marker, 'click', function() {
                            infoWindow.setContent(html);
                            infoWindow.open(map, marker);
                        });
                });
        });
 }

google.setOnLoadCallback(initialize);

</script>
<body><h3>Sitios Recomendados :: MonoNeurona :: Google Maps</h3>
    <div id="map_canvas" style="border: 1px solid black; margin:auto;width:900px; height:800px"></div> 
 </body>
</html>
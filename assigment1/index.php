<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Geo IP Locator</title>
		<style type="text/css" media="screen"><!--
			#outline { position: relative; height: 800px; width: 800px; margin: 18px auto 0; border: solid 1px #999; }
			#caption { width: 260px; left: 48px; top: 318px; position: absolute; visibility: visible; }
			#text { left: 336px; top: 318px; position: absolute; width: 400px; visibility: visible; margin-top: 10px; }
			#title { width: 800px; top: 100px; position: absolute; visibility: visible; }
			p { color: #666; font-size: 16px; font-family: "Lucida Grande", Arial, sans-serif; font-weight: normal; margin-top: 0; }
			h1 { color: #778fbd; font-size: 20px; font-family: "Lucida Grande", Arial, sans-serif; font-weight: 500; line-height: 32px; margin-top: 4px; }
			h2 { color: #778fbd; font-size: 18px; font-family: "Lucida Grande", Arial, sans-serif; font-weight: normal; margin: 0.83em 0 0; }
			h3 { color: #666; font-size: 60px; font-family: "Lucida Grande", Arial, sans-serif; font-weight: bold; text-align: center; letter-spacing: -1px; width: auto; }
			h4 { font-weight: bold; text-align: center; margin: 1.33em 0; }
			a { color: #666; text-decoration: underline; }
		--></style>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBA1pyU5rzqxIyJRTviIe0UttToW9ZB6zg&sensor=false">
    </script>
		
	</head>

	<body onload="callGeoIPService()">
		<div id="outline">
			<div id="title">
				<h3>Geo IP Locator.</h3>
			</div>
			<div id="caption">
				<h1>Your IP</h1>
				<form>
					<input type="text" value="77.251.161.158" id="ip"></input>
					<input type="button" value="Submit" onClick="callGeoIPService();"></input>
				</form>
			</div>
			<div id="text">
				<div id="map_canvas" style="width: 450px; height: 400px"></div>
			</div>
			
		</div>
		
	</body>
	<script>
		function callGeoIPService() {
			var ip = document.getElementById("ip").value;
			var request = $.ajax({
			  url: "geoipservice.php",
			  type: "GET",
			  data: {ip : ip},
			  dataType: "xml",
			  success: function(data) {
				  var $response = $(data);
				  var oneval = $response.find('CountryName').text();
				  convertToGeoCode(oneval);}
			});
		}

	  function convertToGeoCode(countryName) {
		var geocoder = new google.maps.Geocoder();
	    geocoder.geocode({ 'address': countryName}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	        initializeMap(results[0].geometry.location);
	        };
	      })
	  }

      function initializeMap(address) {
          var myOptions = {
            center: address,
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("map_canvas"),
              myOptions);
        }
	  		
	</script>
</html>
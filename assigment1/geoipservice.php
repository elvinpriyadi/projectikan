<?xml version="1.0" encoding="UTF-8"?>
	<?php 
		header('Content-type: text/xml');

		//TODO: add error handling
		require ("nusoap/lib/nusoap.php");
		
		// Create the client instance
		$client = new nusoap_client('http://www.webservicex.net/geoipservice.asmx?WSDL', true);
	
		// Retrieve IP from URL Param
		$myipaddress = $_GET["ip"];
		
		// Call the SOAP method
		$args = array('IPAddress' => $myipaddress);
		$result = $client->call('GetGeoIP', $args);
		
		//IDEA: PHP output XML file
		
	?>

	<GeoIP>
		<IP><?php echo $result["GetGeoIPResult"]["IP"] ?></IP>
		<CountryName><?php echo $result["GetGeoIPResult"]["CountryName"] ?></CountryName>
		<CountryCode><?php echo $result["GetGeoIPResult"]["CountryCode"] ?></CountryCode>
	</GeoIP>
<?php

// This code demonstrates how to lookup the country, region, city,
// postal code, latitude, and longitude by IP Address.
// It is designed to work with GeoIP/GeoLite City

// Note that you must download the New Format of GeoIP City (GEO-133).
// The old format (GEO-132) will not work.

include("../src/geoipcity.inc");
include("../src/geoipregionvars.php");

require_once( dirname(__FILE__) . '/../../../ip/Class.Ip.php');
$_ip = new Ip();

$the_ip = $_ip->getIpRemoteAddr();
echo 'IP: '.$the_ip;
echo '<br>';

// IP compartido
if(isset($_SERVER['HTTP_CLIENT_IP']))
{
	echo "IP Share: " . $_SERVER['HTTP_CLIENT_IP'] . "<br />";
}
else
{
	echo "IP Share: No<br />";
}
// IP Proxy
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
	echo "IP Proxy: " . $_SERVER['HTTP_X_FORWARDED_FOR'] . "<br />";
}
else
{
	echo "IP Proxy: No<br />";
}
// IP Acceso
if(isset($_SERVER['REMOTE_ADDR']))
{
	echo "IP Access: " . $_SERVER['REMOTE_ADDR'] . "<br />";
}
else
{
	echo "IP Access: No<br />";
}


// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);
$gi = geoip_open("../../GeoIP/GeoLiteCity.dat", GEOIP_STANDARD);

if(!empty($the_ip) && $the_ip!='127.0.0.1')
{
	$record = geoip_record_by_addr($gi, $the_ip);
	print $record->country_code . " " . $record->country_code3 . " " . $record->country_name . "\n";
	print $record->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . "\n";
	print $record->city . "\n";
	print $record->postal_code . "\n";
	print $record->latitude . "\n";
	print $record->longitude . "\n";
	print $record->metro_code . "\n";
	print $record->area_code . "\n";
	print $record->continent_code . "\n";
	
	geoip_close($gi);
}
?>

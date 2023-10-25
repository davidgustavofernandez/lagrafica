<?php

// This code demonstrates how to lookup the country by IP Address

include("../src/geoip.inc");

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

// Uncomment if querying against GeoIP/Lite City.
// include("geoipcity.inc");

$gi = geoip_open("../../GeoIP/GeoIP.dat", GEOIP_STANDARD);

if(!empty($the_ip) && $the_ip!='::1')
{
	echo geoip_country_code_by_addr($gi, $the_ip) . "\t" .
		geoip_country_name_by_addr($gi, $the_ip) . "\n";
	echo geoip_country_code_by_addr($gi, $the_ip) . "\t" .
		geoip_country_name_by_addr($gi, $the_ip) . "\n";
	
	geoip_close($gi);
}
else
{
	$the_ip = '181.229.105.180';
	echo "No access FORCE IP TO" . $the_ip .  "<br />";
	
	echo geoip_country_code_by_addr($gi, $the_ip) . "\t" .
		geoip_country_name_by_addr($gi, $the_ip) . "\n";
	echo geoip_country_code_by_addr($gi, $the_ip) . "\t" .
		geoip_country_name_by_addr($gi, $the_ip) . "\n";
	
	geoip_close($gi);
}
?>

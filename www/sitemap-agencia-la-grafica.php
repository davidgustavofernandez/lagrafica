<?php
require_once(dirname(__FILE__) . '/framework/_common/Class.Config.php');
$_c = new Configuration();
require_once(dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');
require_once(dirname(__FILE__) . '/framework/_lib/propagate/Class.Propagate.php');
require_once(dirname(__FILE__) . '/framework/_lib/curl/Class.Curl.php');
require_once(dirname(__FILE__) . '/framework/_lib/functions/Class.Functions.php');

$_e = new ErrorHandler();
$_p = new Propagate();
$_r = new Curl();
$_f = new Functions();

# Recuperamos valores por querystring
$_p->setFilter(true); 		// Aplicamos filtro de injection
$_metodo 					= 'request';

# Variables a tratar
$action             = $_p->spread($_metodo, "action", '');
$token_querystring  = $_p->spread($_metodo, "token", '');
$pager_page          = $_p->spread($_metodo, 'pager_page', 0);
$_debug						= true;

# URL webservices
$webservices = array('URL' => CONFIG_URL_WEBSERVICES);

$pager_quantity = 100;
$paginador_propagate = base64_encode(serialize(array('pager_page' => $pager_page, 'id_service' => $id_service)));
$_y->setKey(CRYPT_VAR_TXT);
$paginadorPropagate = $_y->getEncrypt($paginador_propagate);

# SERVICIOS {
$parameters_n = array(
	'controller'      => 'services',
	'action'          => 'filterPaged',
	'id_patient'      => $id_patient,
	'pager_url'       => '#',
	'pager_page'      => $pager_page,
	'pager_quantity'  => $pager_quantity,
	'pager_propagate' => $paginadorPropagate,
	'order'           => 'date_tracking',
	'sort'            => 'DESC',
	'status'          => '1',
	'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
	'personal_key' => base64_encode('Gy8YotyHfWFvGprYlXc6')
);

$_r->setUrl($webservices);
$_r->setMethod('GET');
$_r->setParams($parameters_n);
$response_n = $_r->getRequest();

if (!empty($response_n)) {
	$retorno_n = json_decode($response_n, true);

	if (is_array($retorno_n) && $retorno_n['error'] == false) {
		$servicios_array = $retorno_n['data'];
	} else {
		$servicios_array = '';
	}
} else {
	## Fallo al consumir servicio
	echo $_m->getPageMensaje('Servicios / Detalle:', 'Servicios', '400');
	exit();
}
# } SERVICIOS

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
/*echo '<?xml-stylesheet type="text/xsl" href="'.CONFIG_HOST_NAME_FRONTEND.'/sitemap.xsl"?>';*/
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php

	if (is_array($servicios_array)) {
		foreach ($servicios_array as $servicios) {
			if (!empty($servicios['id_service'])) {
				echo '<url>';
				echo '    <loc>' . CONFIG_HOST_NAME_FRONTEND . 'cabana/' . $servicios['slug'] . '/</loc>';
				echo '    <lastmod>' . $_f->date_decode($servicios['datetime'], TIME_ZONE, W3C_DATETIME_FORMAT) . TIME_ZONE_OFFSET . '</lastmod>';
				echo '    <changefreq>daily</changefreq>';
				echo '</url>';
			}
		}
	}

	?>
</urlset>
<?php
//http://www.pontikis.net/blog/creating-dynamic-xml-sitemaps-using-php
require_once(dirname(__FILE__) . '/framework/_common/Class.Config.php');
$_c = new Configuration();
require_once(dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');
$_e = new ErrorHandler();

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
// <?xml version="1.0" encoding="UTF-8"? >
// <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemapindex/0.9">
//     <sitemap>
//         <loc>http://www.ejemplo.com/sitemap1.xml.gz</loc>
//         <lastmod>2004-10-01T18:23:17+00:00</lastmod>
//     </sitemap>
//     <sitemap>
//         <loc>http://www.ejemplo.com/sitemap2.xml.gz</loc>
//         <lastmod>2005-01-01</lastmod>
//     </sitemap>
// </sitemapindex>
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemapindex/0.9">
  <sitemap>
    <loc><?php echo CONFIG_HOST_NAME_FRONTEND; ?>sitemap-main.php</loc>
    <lastmod>2023-08-16T00:52:31-03:00</lastmod>
  </sitemap>
</sitemapindex>
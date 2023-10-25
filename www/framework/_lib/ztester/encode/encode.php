<?php
require_once( dirname(__FILE__) . '/../../../_common/Class.Config.php');
$_c = new Configuration();
require_once( dirname(__FILE__) . '../../../handler/Class.Error.Handler.php');
$_e = new ErrorHandler();
require_once( dirname(__FILE__) . '../../../propagate/Class.Propagate.php');
$_p = new Propagate();
$_p->setFilter(true);
$_metodo = 'request';

// Test Encoding
$encode = $_p->spread($_metodo,"encode",'');
$str = $_p->spread($_metodo,"str",'');

echo $encode;
echo '<br>';
echo $str;

// echo iconv( $encode, "utf-8//TRANSLIT", $str );

$tab = array("UTF-8", "ASCII", "Windows-1252", "ISO-8859-15", "ISO-8859-1", "ISO-8859-6", "CP1256");
$chain = "";
foreach ($tab as $i)
    {
        foreach ($tab as $j)
        {
            $chain .= " $i$j ".iconv($i, $j.'//IGNORE', $str).'<br>';
        }
    }

echo $chain; 
?>

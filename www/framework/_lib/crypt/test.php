<?php
require_once( dirname(__FILE__) . '/../../_common/Class.Config.php');
$c = new Configuration();
require_once( dirname(__FILE__) . '/../../_lib/crypt/Class.Crypt.php');

##### Crypt
$dato = 'invitado_1357';
$_crypter = new Crypt();
$_crypter->setKey(CRYPT_VAR_USERS);
$onCrypter = $_crypter->getEncrypt($dato);
echo 'Dato encriptado:<br>';
echo $onCrypter.'<br><br>';

##### Decript
$dato = '1e0a392d1c19355b7842';
$_crypter = new Crypt();
$_crypter->setKey(CRYPT_VAR_USERS);
$offCrypter = $_crypter->getDecrypt($dato);
echo 'Dato desencriptado:<br>';
echo $offCrypter;

echo '<br><br><br><br>';

$claves = array(
'ALICIA1948',
'ALDO44',
'MAXIM22',
'PABLO33',
'RESERVADO',
'3420LU',
'AUDITORIA',
'ENFCUE',
'ASICUE',
'INTEJ',
'GARA2019',
'NORMA2',
'VVH1999T',
'MARIO22N',
'SALUD2016',
'PAULA66',
'SESAM1994',
'MAMA7714',
'SILVA205',
'CUBA2015',
'ATHINA2015',
'GRACIELA28',
'VANESSA71',
'GIGANTE VI',
'MARINECA15',
'RODRIGUEZ',
'ALBENE',
'MOAL2019',
'IN4350MP',
'GREISER LA',
'JOSE1234',
'QUIROGA PA',
'MARIA2319',
'BOYE CLAUD',
'NORLIP53',
'48549950',
'MANYAE',
'1941FE',
'203050JCL',
'TO1967',
'FLOR1701',
'2511',
'LEO16',
'RANCHOS',
'MORRISON',
'SILVIAROS1',
'MERC1996',
'BUS2001',
'BRISA',
'PAULAHOF8'
);

foreach($claves as $clave) {
    $_crypter = new Crypt();
    $_crypter->setKey(CRYPT_VAR_USERS);
    $onCrypter = $_crypter->getEncrypt($clave);
    echo $onCrypter.'<br>';
}

?>
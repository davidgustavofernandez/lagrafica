<?php
require_once( dirname(__FILE__) . '/Class.Validate.php');
echo 'ok';

$data = array (
    'por_birthday' => '2020-083',
);

$post = Validate::factory($data)->rules( 'por_birthday', array('not_empty'=>NULL,'min_length'=>array(10),'validateDate'=>array('Y-m-d') ) );

if ($post->check()) {
    echo 'ok';
}else {
    echo 'no';
}

?>
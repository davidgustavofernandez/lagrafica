<?php
abstract class AppAbstractConnectInstance{
    protected $_conn;

    public function __construct(){
        # Note: Instance of connection to the Database for the whole APP
        $c = new Connect();
        $c->setConn();
        $this->_conn = $c->getConn();
    }
    
    public function __destruct(){}
}
?>
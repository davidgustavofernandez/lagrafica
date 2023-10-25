<?php
/**
 * Crypt, Data encryption
 * 
 * The Crypt Class is in charge of encrypting and encrypting data.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Crypt class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage framework
 */
class Crypt {
    /**
     * Configuration private variable values, 
     */
    /**
     * $_key, CRYPT_VAR
     * @access private
     * @var string
     */
    private $_key = "";
    /**
     * __construct function
     * @see __construct()
     * @uses $this->setKey, Function
     * Note: Constructor
     */
    public function __construct(){
        if($this->_key==''){
            $this->setKey();
        }
    }
    /**
     * setKey function
     * @uses $this->_key, String
     * Note: Function that sets the key to apply
     */
    public function setKey($key=''){
        if($key==''){
            $this->_key = "Mama, they try and break me. the window burns to light the way back home a light that warms no matter where they've gone. they're off to find the hero of the day but what if they should fall by someone's wicked way? still the window burns, time so slowly turns someone there is sighing keepers of the flames do you feel your names? do you hear your babies crying? mama they try and break me still they try and break me scuse me while i tend to how i feel these things return to me that still seem real now deservingly this easy chair but the rocking stops by wheels of despair don't want your aid but the fist i've made for years won't hold or feel no i'm not all me so please excuse me while i tend to how i fell but now the dreams and waking screams that ever last through the night (echoed between james and jason) So build the wall behind it crawl and hide until it's light can you hear your babies crying now? still the window burns time so slowly turns and someone there is sighing keepers of the flames, can't you feel your names? can't you hear your babies crying? but now the dreams and waking screams that ever last the night so build a wall behind it crawl and hide until it's light so can't you hear your babies crying now? mama they try and break me";// Metallica (Hero of the Day)
        }else{
            $this->_key = $key;
        }
    }
    /**
     * getEncrypt function
     * @uses $this->_strEncrypted, Object
     * @uses $this->_str2hex(), Function
     * @uses $this->_cryptDecrypt(), Function
     * Note: Function that returns an encrypted value
     * @return string
     */
    public function getEncrypt($strEncrypted){
        $encrypt = $this->_str2hex($this->_cryptDecrypt($strEncrypted));
        return $encrypt;
    }
    /**
     * getDecrypt function
     * @uses $this->_strDecrypted, Object
     * @uses $this->_hex2str(), Function
     * @uses $this->_cryptDecrypt(), Function
     * Note: Function that returns the decrypted value
     * @return string
     */
    public function getDecrypt($strDecrypted){
        $decrypted = $this->_cryptDecrypt($this->_hex2str($strDecrypted));	
        return $decrypted;
    }
    /**
     * _cryptDecrypt function
     * @uses $str, String
     * @uses $this->_key, String
     * Note: Function that decrypts
     * @return string
     */
    private function _cryptDecrypt($str){
        $iKey=0;
        $strReturn = "";
        for($i=0;$i<strlen($str);$i++){
            $strReturn .= $str[$i]^$this->_key[$iKey];
            $iKey++;
            if($this->_key[$iKey]=="") $iKey=0;
        }
        return $strReturn;
    }	
    /**
     * _hex2str function
     * @uses $str, String
     * Note: Function that passes an EXADECIMAL to a STRING
     * @return string
     */
    private function _hex2str($str){
        $strReturn = "";
        for($i=2;$i<strlen($str)+2;$i+=2){
            $strReturn .= chr(hexdec($str[$i-2].$str[$i-1]));
        }
        return $strReturn;
    }
    /**
     * _str2hex function
     * @uses $str, String
     * Note: Function that passes a STRING to its value HEXADECIMAL
     * @return string
     */
    private function _str2hex($str){
        $strReturn = "";
        for($i=0; $i<strlen($str); $i++){
            $s_caracterenhex = dechex(ord($str[$i]));
            if(strlen($s_caracterenhex)==1){
                $strReturn .= "0$s_caracterenhex";
            }else{
                $strReturn .= $s_caracterenhex;
            }
        }
        return $strReturn;
    }
    /**
     * __destruct public function
     * Note: Clears the object when it is no longer used
     * @see __destruct()
     */
    public function __destruct(){
        //unset($this);
    }
}
?>
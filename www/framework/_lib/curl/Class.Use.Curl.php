<?php
/**
 * UseCurl, Generate queries using CURL
 * 
 * The UseCurl Class returns the content of a URL.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
/**
 * UseCurl class, 
 * Return: String or Json
 */
class UseCurl{
    private $_curl_url;
    private $_curl_if_available = false;
    private $_curl_result;
    private $_curl_useragent;
    private $_curl_method;

    /**
     * Constructor sets up
     * @see __construct()
     */
    public function __construct()
    {
        $this->setUseragent();
        $this->setMethod();
        $this->setCurlAvailable();
    }

    public function setUseragent($useragent=''){
        if(empty($useragent)){
            $this->_curl_useragent = 'Facebook API PHP5 Client 1.1 (curl) ' . phpversion();
        }else{
            $this->_curl_useragent = $useragent;
        }
    }

    public function setMethod($method='POST'){
        $this->_curl_method = $method;
    }

    public function setCurlAvailable(){
        if (function_exists('curl_init')){
            $this->_curl_if_available = true;
        }else{
            $this->_curl_if_available = false;
        }
    }

    public function setUrl($url=''){
        if(empty($url)){
            $this->_curl_result = 'error: need url string';
            return $this->_curl_result;
        }else{
            $this->_curl_url = $url;
        }
    }

    public function setPostString($postString=''){
        if(empty($postString)){
            $this->_curl_result = 'error: need string to post';
            return $this->_curl_result;
        }else{
            $this->_curl_post_string = $postString;
        }
    }

    /**
    * execute a curl transaction -- this exists mostly so subclasses can add
    * extra options and/or process the response, if they wish.
    *
    * @param resource $ch a curl handle
    */
    protected function curl_exec($ch) {
        $result = curl_exec($ch);
        return $result;
    }

    public function do_request() {
        if ($this->_curl_if_available){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->_curl_url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_curl_post_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->_curl_useragent);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $this->_curl_result = $this->curl_exec($ch);
            curl_close($ch);
        }else{
            $this->_curl_result = 'curl is not habalible';
        }

        return $this->_curl_result;
    }
}
?>
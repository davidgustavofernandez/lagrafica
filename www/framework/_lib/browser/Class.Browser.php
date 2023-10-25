<?php
 /**
 * Browser, Trata el tipo de browswe del usuario
 * 
 * La Calsse Browser es la encargada de retornar que tipo de plataforma, browser y version tiene el usuario 
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Browser class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage Browser
 */

class Browser
{
	/**
	 * Configuration values
     * @access private
	 * @var string $_name
	 */
	private $_name = false;
	
	/**
	 * Configuration values
     * @access private
	 * @var string $version
	 */
	private $_version = false;
	
	/**
	 * Configuration values
     * @access private
	 * @var $useragent
	 */
	private $_useragent = false;
	
	/**
	 * Configuration values
     * @access private
	 * @var string $platform
	 */
	private $_platform;
	
	/**
	 * Configuration values
     * @access private
	 * @var string aol
	 */
	private $_aol = false;
	
	/**
	 * Configuration values
     * @access private
	 * @var string browser
	 */
	private $_browsertype;
	
	/**
     * Constructor
     * @uses $_SERVER, Array
     * @uses _useragent
	 * @see __construct()
	 * Note: Configura los datos del usuario / useragent
     */
	public function __construct()
	{
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$this->_useragent = $agent;
	}
	
	/**
	 * Method to get the browser details from the USER_AGENT string in 
	 *
	 * the PHP superglobals
	 * @param void
	 * @return string property platform 
	 */
	public function _getBrowserOS()
	{
		$win 	= preg_match('/win/i', 	$this->_useragent);
		$linux 	= preg_match('/linux/i', 	$this->_useragent);
		$mac 	= preg_match('/mac/i', 	$this->_useragent);
		$os2 	= preg_match('/OS\/2/i', 	$this->_useragent);
		$beos 	= preg_match('/BeOS/i', 	$this->_useragent);
		/*
		$win 	= eregi("win", 		$this->_useragent);
		$linux 	= eregi("linux", 	$this->_useragent);
		$mac 	= eregi("mac", 		$this->_useragent);
		$os2 	= eregi("OS/2", 	$this->_useragent);
		$beos 	= eregi("BeOS", 	$this->_useragent);
		*/
		//now do the check as to which matches and return it
		if($win)
		{
			$this->_platform = "Windows";
		}
		elseif ($linux)
		{
			$this->_platform = "Linux"; 
		}
		elseif ($mac)
		{
			$this->_platform = "Macintosh"; 
		}
		elseif ($os2)
		{
			$this->_platform = "OS/2"; 
		}
		elseif ($beos)
		{
			$this->_platform = "BeOS"; 
		}
		return $this->_platform;
	}
	
	/**
	 * Method to test for Opera
	 *
	 * @param void
	 * @return property $broswer
	 * @return property version
	 * @return bool false on failure
	 */
	private function _isOpera()
	{
		// test for Opera		
		if (preg_match('/opera/i',$this->_useragent))
		{
			$val = stristr($this->_useragent, "opera");
			if (preg_match('/', $val)){
				$val = explode("/",$val);
				$this->_browsertype = $val[0];
				$val = explode(" ",$val[1]);
				$this->_version = $val[0];
			}else{
				$val = explode(" ",stristr($val,"opera"));
				$this->_browsertype = $val[0];
				$this->_version = $val[1];
			}
			return true;
		}
		else {
			return true;
		}
	}
	
	/**
	 * Method to check for FireFox
	 *
	 * @param void
	 * @return bool false on failure
	 */ 
	private function _isFirefox()
	{
		if(preg_match('/Firefox/i', $this->_useragent))
		{
			$this->_browsertype = "Firefox"; 
			$val = stristr($this->_useragent, "Firefox");
			$val = explode("/",$val);
			$val = explode(" ",$val[1]);
			$this->_version = $val[0];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Flock
	 *
	 * @param void
	 * @return bool false on failure
	 */ 
	private function _isFlock()
	{
		if(preg_match('/Flock/i', $this->_useragent))
		{
			$this->_browsertype = "Flock"; 
			$val = stristr($this->_useragent, "Flock");
			$val = explode("/",$val);
			$val = explode(" ",$val[1]);
			$this->_version = $val[0];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Konquerer
	 *
	 * @param void
	 * @return prop $browser
	 * @return prop $version
	 * @return bool true on success
	 */
	private function _isKonqueror()
	{
		if(preg_match('/Konqueror/i',$this->_useragent))
		{
			$val = explode(" ",stristr($this->useragent,"Konqueror"));
			$val = explode("/",$val[0]);
			$this->_browsertype = $val[0];
			$this->_version = str_replace(")","",$val[1]);
			return true;
		}
		else {
			return false;
		}
		
	}//end func
	
	/**
	 * Method to check for Internet Explorer v1
	 *
	 * @param void
	 * @return bool true on success
	 * @return prop $browsertype
	 * @return prop $version
	 */
	private function _isIEv1()
	{
		if(preg_match('/microsoft internet explorer/i', $this->_useragent))
		{
			$this->_browsertype = "MSIE"; 
			$this->_version = "1.0";
			$var = stristr($this->_useragent, "/");
			if (ereg("308|425|426|474|0b1", $var))
			{
				$this->_version = "1.5";
			}
			return true;
		}
		else {
			return false;
		}
	}//end function
	
	/**
	 * Method to check for Internet Explorer later than v1
	 *
	 * @param void
	 * @return bool true on success
	 * @return prop $browsertype
	 * @return prop $version
	 */
	private function _isMSIE()
	{
		if(preg_match('/msie/i', $this->_useragent) && !preg_match('/opera/i',$this->_useragent))
		{
			$this->_browsertype = "Internet Explorer";
			$val = explode(" ",stristr($this->_useragent,"msie"));
			$ver = str_replace(";","",$val[1]);
			//$this->browsertype = $val[0];
			$this->_version = $ver;
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Chrome later than v1
	 *
	 * @param void
	 * @return bool true on success
	 * @return prop $browsertype
	 * @return prop $version
	 */
	private function _isChrome()
	{
		if(preg_match('/chrome/i', $this->_useragent))
		{
			$this->_browsertype = "Chrome";
			$val = stristr($this->_useragent, "Chrome");
			$val = explode("/",$val);
			$val = explode(" ",$val[1]);
			$this->_version = $val[0];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Galeon
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isGaleon()
	{
		if(preg_match('/galeon/i',$this->_useragent))
		{
			$val = explode(" ",stristr($this->_useragent,"galeon"));
			$val = explode("/",$val[0]);
			$this->_browsertype = $val[0];
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}//end func
	
	/**
	 * Now we do the tests for browsers I can't test...
	 * If someone finds a bug, please report it ASAP to me please!
	 */
	
	/**
	 * Method to check for WebTV browser
	 *
	 * @param void
	 * @return bool true on success
	 * @return prop $browsertype
	 * @return prop $version
	 */
	private function _isWebTV()
	{
		if(preg_match('/webtv/i',$this->_useragent))
		{
			$val = explode("/",stristr($this->_useragent,"webtv"));
			$this->_browsertype = $val[0];
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for BeOS's NetPositive
	 *
	 * @param void
	 * @return bool true on success
	 * @return prop $browsertype
	 * @return prop $version
	 */
	private function _isNetPositive()
	{
		if(preg_match('/NetPositive/i', $this->_useragent))
		{
			$val = explode("/",stristr($this->_useragent,"NetPositive"));
			$this->_platform = "BeOS"; 
			$this->_browsertype = $val[0];
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for MSPIE (Pocket IE)
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isMSPIE()
	{
		if(preg_match('/mspie/i',$this->_useragent) || preg_match('/pocket/i', $this->_useragent))
		{
			$val = explode(" ",stristr($this->_useragent,"mspie"));
			$this->_browsertype = "MSPIE"; 
			$this->_platform = "WindowsCE"; 
			if (preg_match('/mspie/i', $this->_useragent))
				$this->_version = $val[1];
			else {
				$val = explode("/",$this->_useragent);
				$this->_version = $val[1];
			}
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to test for iCab
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isIcab()
	{
		if(preg_match('/icab/i',$this->_useragent))
		{
			$val = explode(" ",stristr($this->_useragent,"icab"));
			$this->_browsertype = $val[0];
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;

		}
	}
	
	/**
	 * Method to test for the OmniWeb Browser
	 *
	 * @param void
	 * @return bool True on success
	 */
	private function _isOmniWeb()
	{
		if(preg_match('/omniweb/i',$this->_useragent))
		{
			$val = explode("/",stristr($this->_useragent,"omniweb"));
			$this->_browsertype = $val[0];
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Phoenix Browser
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isPhoenix()
	{
		if(preg_match('/Phoenix/i', $this->_useragent))
		{
			$this->_browsertype = "Phoenix"; 
			$val = explode("/", stristr($this->_useragent,"Phoenix/"));
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Firebird
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isFirebird()
	{
		if(preg_match('/firebird/i', $this->_useragent))
		{
			$this->_browsertype = "Firebird"; 
			$val = stristr($this->_useragent, "Firebird");
			$val = explode("/",$val);
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Mozilla alpha/beta
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isMozAlphaBeta()
	{
		if(preg_match('/mozilla/i',$this->_useragent) && 
		   preg_match('/rv:[0-9].[0-9][a-b]/i',$this->_useragent) && 
		   !preg_match('/netscape/i',$this->_useragent))
		
		{
			$this->_browsertype = "Mozilla"; 
			$val = explode(" ",stristr($this->_useragent,"rv:"));
			preg_match('/rv:[0-9].[0-9][a-b]/i',$this->_useragent,$val);
			$this->_version = str_replace("rv:","",$val[0]);
			return true;
		}
		else {
			return false;
		}
	}//end function

	/**
	 * Method to check for Mozilla Stable versions
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isMozStable()
	{
		if(preg_match('/mozilla/i',$this->_useragent) &&
		   preg_match('/rv:[0-9]\.[0-9]/i',$this->_useragent) && 
		   !preg_match('/netscape/i',$this->_useragent))
		{
			$this->_browsertype = "Mozilla"; 
			$val = explode(" ",stristr($this->_useragent,"rv:"));
			preg_match('/rv:[0-9]\.[0-9]\.[0-9]/i',$this->_useragent,$val);
			$this->_version = str_replace("rv:","",$val[0]);
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Method to check for Lynx and Amaya
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isLynx()
	{
		if(preg_match('/libwww/i', $this->_useragent))
		{
			if (preg_match('/amaya/i', $this->_useragent))
			{
				$val = explode("/",stristr($this->_useragent,"amaya"));
				$this->_browsertype = "Amaya"; 
				$val = explode(" ", $val[1]);
				$this->_version = $val[0];
			} else {
				$val = explode("/",$this->_useragent);
				$this->_browsertype = "Lynx"; 
				$this->_version = $val[1];
			}
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * method to check for safari browser
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isSafari()
	{
		if(preg_match('/safari/i', $this->_useragent))
		{
			$this->_browsertype = "Safari"; 
			$val = stristr($this->_useragent, "Safari");
			$val = explode("/",$val);
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Various tests for Netscrape
	 *
	 * @param void
	 * @return bool true on success
	 */
	private function _isNetscape()
	{
		if(preg_match('/netscape/i',$this->_useragent))
		{
			$val = explode(" ",stristr($this->_useragent,"netscape"));
			$val = explode("/",$val[0]);
			$this->_browsertype = $val[0];
			$this->_version = $val[1];
			return true;
		}
		elseif(preg_match('/mozilla/i',$this->_useragent) && 
				!preg_match('/rv:[0-9]\.[0-9]\.[0-9]/i',$this->_useragent))
		{
			$val = explode(" ",stristr($this->_useragent,"mozilla"));
			$val = explode("/",$val[0]);
			$this->_browsertype = "Netscape"; 
			$this->_version = $val[1];
			return true;
		}
		else {
			return false;
		}
	}//end func
	
	/**
	 * Method to check for AOL connections
	 *
	 * @param void
	 * @return bool true on Success
	 */
	private function _isAOL()
	{
		if (preg_match('/AOL/i', $this->_useragent)){
			$var = stristr($this->_useragent, "AOL");
			$var = explode(" ", $var);
			$this->_aol = ereg_replace("[^0-9,.,a-z,A-Z]", "", $var[1]);
			return true;
		}
		else { 
			return false;
		}
	}
	
	/**
	 * Method to tie them all up and output something useful
	 *
	 * @param void
	 * @return array
	 */
	public function getBrowser()
	{
		$this->_getBrowserOS();
		$this->_isOpera();
		$this->_isFirefox();
		$this->_isFlock();
		$this->_isKonqueror();
		$this->_isIEv1();
		$this->_isMSIE();
		$this->_isGaleon();
		$this->_isNetPositive();
		$this->_isMSPIE();
		$this->_isIcab();
		$this->_isOmniWeb();
		$this->_isPhoenix();
		$this->_isFirebird();
		$this->_isLynx();
		$this->_isSafari();
		$this->_isChrome();
		//$this->_isMozAlphaBeta();
		//$this->_isMozStable();
		//$this->_isNetscape();
		$this->_isAOL();
		return array('browsertype' => $this->_browsertype, 
					 'version' => $this->_version, 
					 'platform' => $this->_platform, 
					 'AOL' => $this->_aol); 
	}
	
	/**
	 * Method to tie them all up and output something useful
	 *
	 * @param void
	 * @return array
	 */
	public function getBrowserIe()
	{
		$this->_isMSIE();
		return array('browsertype' => $this->_browsertype, 
					 'version' => $this->_version, 
					 'platform' => $this->_platform, 
					 'AOL' => $this->_aol); 
	}
	
	/**
     * Destructor sets up
	 * @see __destruct()
     */
	public function __destruct()
	{
		//unset($this);
	}
}//end class
?>
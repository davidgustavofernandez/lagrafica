<?php
class ReadDatabaseDump
{
	private $_file = '';
	private $_controller = '';

	/**
     * setController public function 
	 * @uses $this->_controller, String
	 * @uses $controller, String
	 * Note: Funcion encargada de setear el tabla / controller
     */
	public function setController($file,$controller)
	{
		$this->_file = $file;
		$this->_controller = $controller;
	}
	/**
     * Destructor sets up
	 * @see __destruct()
     */
	public function __destruct()
	{
		//unset($this);
	}
	/**
     * getControllerEstructure public function 
	 * @uses dirname, file_exists, is_file, Function
	 * Note: Funcion encargada de devolver el contenido de la estructura
     */
	public function getControllerEstructure()
	{
		$structurePath = dirname(__FILE__).'/../structure/'.$this->_file;
		
		if(file_exists($structurePath) && is_file($structurePath))
		{
			require_once($structurePath);
			$tableName = $this->_controller;
			$controller = new $tableName();
			$structureData = $controller->getStructure();
			return $structureData;
		}
		else
		{
			$message = array('e: no se encontro el controlador (file)');
			return $message;
		}
	}
	
}
?>
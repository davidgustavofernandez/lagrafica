<?php
/**
 * QueryBuilder, Trata y genera las Querys
 * 
 * La Calsse QueryBuilder es la encargada de tratar y construir la querys a ser aplicadas a la base de datos.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * QueryBuilder class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage framework
 */
class QueryBuilder {	
	/**
	 * Configuration private variable values, 
	 * 
	 * Configuration values
	 * @access private
	 * @var array
	 */
	private $_data = array();
	
	/**
	 * Configuration values
	 * @access private
	 * @var string
	 */
	private $_query = "";
	
	/**
	 * setData function
	 *
	 * Note: Funcion que trata dispone la consulta para ser usada
	 * @param  array $data
	 */
	public function setData($data)
	{
		$this->_data 	= $data;
	}
	
	/**
	 * getQuery function
	 *
	 * Note: Funcion retorna la query
	 * @return string
	 */
	public function getQuery()
	{
		return $this->_query;
	}
	
	/**
     * build function
	 * @uses $this->_query, Object
	 * Note: Funcion que setea la key a aplicar
	 */
	public function build()
	{
		if (is_array($this->_data))
		{
			if (isset($this->_data['SELECT']) && is_array($this->_data))
			{
				if (isset($this->_data['FROM']))
				{
					$this->_query = 'SELECT '.$this->_data['SELECT'].' FROM '.(isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').$this->_data['FROM'];
				}
				else
				{
					$this->_query = 'SELECT '.$this->_data['SELECT'];
				}
				
				if (isset($this->_data['JOINS']))
				{
					foreach ($this->_data['JOINS'] as $joing){
						$this->_query .= ' '.key($joing).' '.(isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').current($joing).' ON '.$joing['ON'];
					}
				}
	
				if (!empty($this->_data['WHERE'])){
					$this->_query .= ' WHERE '.$this->_data['WHERE'];
				}
				if (!empty($this->_data['GROUP BY'])){
					$this->_query .= ' GROUP BY '.$this->_data['GROUP BY'];
				}
				if (!empty($this->_data['HAVING'])){
					$this->_query .= ' HAVING '.$this->_data['HAVING'];
				}
				if (!empty($this->_data['ORDER BY'])){
					$this->_query .= ' ORDER BY '.$this->_data['ORDER BY'];
				}
				if (!empty($this->_data['LIMIT'])){
					$this->_query .= ' LIMIT '.$this->_data['LIMIT'];
				}
			}
			else if (isset($this->_data['INSERT']))
			{
				$this->_query = 'INSERT INTO '.(isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').$this->_data['INTO'];
	
				if (!empty($this->_data['INSERT'])){
					$this->_query .= ' ('.$this->_data['INSERT'].')';
				}
				if (is_array($this->_data['VALUES'])){
					$this->_query .= ' VALUES('.implode('),(', $this->_data['VALUES']).')';
				}
				else
				{
					$this->_query .= ' VALUES('.$this->_data['VALUES'].')';
				}
			}
			else if (isset($this->_data['UPDATE']))
			{
				$this->_data['UPDATE'] = (isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').$this->_data['UPDATE'];
	
				$this->_query = 'UPDATE '.$this->_data['UPDATE'].' SET '.$this->_data['SET'];
	
				if (!empty($this->_data['WHERE'])){
					$this->_query .= ' WHERE '.$this->_data['WHERE'];
				}
			}
			else if (isset($this->_data['DELETE']))
			{
				$this->_query = 'DELETE FROM '.(isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').$this->_data['DELETE'];
	
				if (!empty($this->_data['WHERE'])){
					$this->_query .= ' WHERE '.$this->_data['WHERE'];
				}
			}
			else if (isset($this->_data['REPLACE']))
			{
				$this->_query = 'REPLACE INTO '.(isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').$this->_data['INTO'];
	
				if (!empty($this->_data['REPLACE'])){
					$this->_query .= ' ('.$this->_data['REPLACE'].')';
				}
	
				$this->_query .= ' VALUES('.$this->_data['VALUES'].')';
			}
			else if (isset($this->_data['SHOW']))
			{
				if (isset($this->_data['FROM']))
				{
					$this->_query = 'SHOW '.$this->_data['SHOW'].' FROM '.(isset($this->_data['PREFIX']) ? $this->_data['PREFIX'] : '').$this->_data['FROM'];
				}
				else
				{
					$this->_query = 'SHOW '.$this->_data['SHOW'];
				}
			}
		}
		else
		{
			$this->_query = 'ERROR';
		}
	}
	
	/**
     * Destructor sets up
	 * @see __destruct()
     */
	public function __destruct()
	{
		//unset($this);
	}
	
}

?>
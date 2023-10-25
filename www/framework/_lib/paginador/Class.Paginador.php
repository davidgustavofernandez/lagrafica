<?php
/**
 * Paginador, Para paginar los records
 * 
 * La Calsse Paginador es la encargada generar el paginador para las listas
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Paginador class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class Paginador
{	
	public $_records;
	public $_pager_url;
	public $_pager_quantity;
	public $_pager_page;
	public $_link;
	public $_propaga;

	public function setRecords($records=0)
	{
		$this->_records = $records;
	}
    public function setPagerUrl($pager_url='index.php'){
        $this->_pager_url = $pager_url;
    }
	public function setPagerQuantity($pager_quantity=10)
	{
		$this->_pager_quantity = $pager_quantity;
	}
	public function setPagerPage($pager_page=0)
	{
		$this->_pager_page = (int) $pager_page;
	}
	// public function setLink($link='index.php')
	// {
	// 	$this->_link = $link;
	// }
	public function setPropaga($propaga)
	{
		$this->_propaga = $propaga;
	}
	/**
	 * paginado function
	 * 
	 * Note: Funcion pagina los records he imprime un flechas y polldown
	 * @uses $_ecords, anothervar (Records, total items a paginar)
	 * @uses $_pager_quantity, anothervar (Cantidad a paginar, total de items a moistrar por pagina)
	 * @uses $_pager_page, anothervar (página actual)
	 * @uses $_link, anothervar (go to url)
	 * @uses $_propaga, anothervar (go to url)
	 * @return string html con combo de opciones
	 */
	public function paginado()
	{
		$argumentos = '';
		
		if ($this->_records>'1')
		{
			if(is_array($this->_propaga))
			{
                if( isset($_REQUEST) )
                {
                    foreach($_REQUEST as $var=>$value)
                    {
                        if(in_array($var, $this->_propaga))
                        {
                            if(!empty($value))
                            {
                                $argumentos .= $var . '=' . $value . '&';
                            }
                        }
                    }
                }
			}
			
			$cp = ceil($this->_records / $this->_pager_quantity);
		
			if ($this->_pager_page)
			{
				$desde = ($this->_pager_page * $this->_pager_quantity);		
				$hasta = $this->_pager_quantity;			
			}
			else
			{		
				$desde = 0;						
				$hasta = $this->_pager_quantity;			
			}
		
			$tempCp = $cp;
			$tempPaginaMasUno = $this->_pager_page +1;
			$tempPaginaMenosUno = $this->_pager_page -1;
			$sel = "<select name=selGo onchange=\"window.location='".$this->_pager_url."?".$argumentos."pager_page='+this.value\">";
						
			for ($c=0; $c<$cp; $c++)
			{
				$temp = $c +1;
				if ($this->_pager_page==$c)
				{
					$modo = 'selected';
					$sel .= "<option $modo value=$c>$temp</option>";
				}
				else
				{
					$modo = '';
					$sel .= "<option $modo value=$c>$temp</option>";
				}
			}
			$sel .= "</select>";
		
			if ($tempPaginaMasUno!=1)
			{
				$primero = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous\"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=0';\">‹‹</a></li>"."\r";
			}
			else
			{
				$primero = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">‹‹</a></li>"."\r";
			}
		
			if ($this->_pager_page)
			{
				$anterior = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous \"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMenosUno."';\">‹</a></li>"."\r";
			}
			else
			{
				$anterior = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">‹</a></li>"."\r";
			}		
		
			if ($cp != $tempPaginaMasUno)
			{
				$siguiente = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous\"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMasUno."';\">›</a></li>"."\r";
			}
			else
			{		
				$siguiente = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">›</a></li>"."\r";
			}
		
			if ($cp != $tempPaginaMasUno)
			{
				$ultimo = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous\"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=".--$tempCp."';\">››</a></li>"."\r";
			}
			else
			{
				$ultimo = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">››</a></li>"."\r";
			}
		
			$temp = $desde+1;
			$temp2 = $tempPaginaMasUno * $this->_pager_quantity;
			
			if ($temp2 > $this->_records)
			{
				$temp2 = $this->_records;
			}
			
			$retorno = '';
			$retorno .= '<ul class="pagination">'."\r";
			$retorno .= '  '.$primero.''."\r";
			$retorno .= '  '.$anterior.''."\r";
			$retorno .= '  <li class="paginate_button select"><span style="padding: 5px 12px">Página  '.$sel.'  de '.$cp.'</span></li>'."\r";
			$retorno .= '  <li class="paginate_button "><span>Registros '.$temp.' al '.$temp2.' de '.$this->_records.'</span></li>'."\r";
			$retorno .= '  '.$siguiente.''."\r";
			$retorno .= '  '.$ultimo.''."\r";
			$retorno .= '</ul>'."\r";
			return $retorno;
		}
	}
	/**
	 * paginado function
	 * 
	 * Note: Funcion pagina los records he imprime un flechas y polldown
	 * @uses $_ecords, anothervar (Records, total items a paginar)
	 * @uses $_pager_quantity, anothervar (Cantidad a paginar, total de items a moistrar por pagina)
	 * @uses $_pager_page, anothervar (página actual)
	 * @uses $_pager_url, anothervar (go to url)
	 * @uses $_propaga, anothervar (go to url)
	 * @return string html con combo de opciones
	 */
	public function paginadoCiego()
	{
		$argumentos = '';
		
		if ($this->_records>'1')
		{
			if(is_array($this->_propaga))
			{
				if(isset($_GET))
				{
					foreach($_GET as $var=> $val)
					{
						if(in_array( $var, $this->_propaga ))
						{
							$argumentos .= $var . '=' . $val . '&';
						}
					}
				}	
			}
			
			$cp = ceil($this->_records / $this->_pager_quantity);
		
			if ($this->_pager_page)
			{
				$desde = ($this->_pager_page * $this->_pager_quantity);		
				$hasta = $this->_pager_quantity;			
			}
			else
			{		
				$desde = 0;						
				$hasta = $this->_pager_quantity;			
			}
		
			$tempCp = $cp;
			$tempPaginaMasUno = $this->_pager_page +1;
			$tempPaginaMenosUno = $this->_pager_page -1;
			
			## «
			if ($tempPaginaMasUno!=1)
			{
				$primero = $this->_pager_url."?".$argumentos."pager_page=0";
			}
			else
			{
				$primero = "";
			}
			## ‹
			if ($this->_pager_page)
			{
				$anterior = $this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMenosUno."&";
			}
			else
			{
				$anterior = "";
			}		
			## ›
			if ($cp != $tempPaginaMasUno)
			{
				$siguiente = $this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMasUno."&";
			}
			else
			{		
				$siguiente = "";
			}
			## ››
			if ($cp != $tempPaginaMasUno)
			{
				$ultimo = $this->_pager_url."?".$argumentos."pager_page=".--$tempCp."&";
			}
			else
			{
				$ultimo = "";
			}
		
			$temp = $desde+1;
			$temp2 = $tempPaginaMasUno * $this->_pager_quantity;
			
			if ($temp2 > $this->_records)
			{
				$temp2 = $this->_records;
			}
			
			$retorno = array( 
							 'total' => $this->_records,
							 'primero' => $primero,
							 'ultimo' => $ultimo,
							 'anterior' => $anterior,
							 'siguiente' => $siguiente
							 );
			return $retorno;
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
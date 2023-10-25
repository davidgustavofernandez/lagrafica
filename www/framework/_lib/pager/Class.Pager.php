<?php
/**
 * Pager, View of pager
 * 
 * La Classe Pager is responsible for generating the Pager for the lists
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 17/05/2019)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Pager class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class Pager
{	
	public $_records;
	public $_pager_type;
	public $_pager_url;
	public $_pager_quantity;
	public $_pager_page;
	public $_pager_propagate = array();

	public function setRecords($records=0)
	{
		$this->_records = $records;
  }
  public function setPagerType($pager_type='html'){
    $this->_pager_type = $pager_type;
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
	public function setPagerPropagate($pager_propagate)
	{
		$this->_pager_propagate = $pager_propagate;
	}
	/**
	 * paged function
	 * 
	 * Note: Page records I have printed directional arrows and polldown
	 * @uses $_ecords, another var (Records, total items to page)
	 * @uses $_pager_quantity, another var (Amount to page, total of items to show per page)
	 * @uses $_pager_page, another var (actual page)
	 * @uses $_pager_propagate, another var (Add vars to url)
	 * @return html string with options combo
	 */
	public function paged()
	{
		$argumentos = '';
		
		if($this->_records>'1')
		{
			
			if(is_array($this->_pager_propagate))
			{
	      if(isset($_REQUEST))
	      {
	        if(array_key_exists("pager_page",$this->_pager_propagate))
	        {
	        	foreach($this->_pager_propagate as $var=>$value)
	          {
	            if(!empty($value))
              {
                $argumentos .= $var . '=' . $value . '&';
              }
	          }
	        }
	        elseif($this->_pager_propagate[0] == 'controller')
          {
	          foreach($_REQUEST as $var=>$value)
	          {
	            if(in_array($var, $this->_pager_propagate))
	            {
	              if(!empty($value))
	              {
	                $argumentos .= $var . '=' . $value . '&';
	              }
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
        if($this->_pager_type=='array'){
          $primero = $this->_pager_url."?".$argumentos."pager_page=0";
        }else{
          $primero = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous\"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=0';\">‹‹</a></li>"."\r";
        }
			}
			else
			{
        if($this->_pager_type=='array'){
          $primero = '';
        }else{
          $primero = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">‹‹</a></li>"."\r";
        }
      }
		
			if ($this->_pager_page)
			{
				if($this->_pager_type=='array'){
          $anterior = $this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMenosUno."&";
        }else{
          $anterior = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous \"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMenosUno."';\">‹</a></li>"."\r";
        }
      }
			else
			{
				if($this->_pager_type=='array'){
          $anterior = '';
        }else{
          $anterior = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">‹</a></li>"."\r";
        }
      }
		
			if ($cp != $tempPaginaMasUno)
			{
				if($this->_pager_type=='array'){
          $siguiente = $this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMasUno."&";
        }else{
          $siguiente = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous\"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=".$tempPaginaMasUno."';\">›</a></li>"."\r";
        }
      }
			else
			{		
				if($this->_pager_type=='array'){
          $siguiente = '';
        }else{
          $siguiente = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">›</a></li>"."\r";
        }
      }
		
			if ($cp != $tempPaginaMasUno)
			{
				if($this->_pager_type=='array'){
          $ultimo = $this->_pager_url."?".$argumentos."pager_page=".--$tempCp."&";
        }else{
          $ultimo = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous\"><a href=\"javascript:window.location='".$this->_pager_url."?".$argumentos."pager_page=".--$tempCp."';\">››</a></li>"."\r";
        }
      }
			else
			{
				if($this->_pager_type=='array'){
          $ultimo = '';
        }else{
          $ultimo = "<li id=\"DataTables_Table_0_previous\" class=\"paginate_button previous disabled\"><a href=\"#\">››</a></li>"."\r";
        }
      }
		
			$temp = $desde+1;
			$temp2 = $tempPaginaMasUno * $this->_pager_quantity;
			
			if ($temp2 > $this->_records)
			{
				$temp2 = $this->_records;
      }
      if($this->_pager_type=='array'){
        $retorno = array( 
          'total' => $this->_records,
          'primero' => $primero,
          'ultimo' => $ultimo,
          'anterior' => $anterior,
          'siguiente' => $siguiente
        );
      }else{
        $retorno = '';
        $retorno .= '<ul class="pagination">'."\r";
        $retorno .= '  '.$primero.''."\r";
        $retorno .= '  '.$anterior.''."\r";
        $retorno .= '  <li class="paginate_button select"><span style="padding: 5px 12px">Página  '.$sel.'  de '.$cp.'</span></li>'."\r";
        $retorno .= '  <li class="paginate_button "><span>Registros '.$temp.' al '.$temp2.' de '.$this->_records.'</span></li>'."\r";
        $retorno .= '  '.$siguiente.''."\r";
        $retorno .= '  '.$ultimo.''."\r";
        $retorno .= '</ul>'."\r";
      }
			return $retorno;
		}
	}
	/**
	 * paginado function
	 * 
	 * Note: Funcion pagina los records he imprime un flechas y polldown
	 * @uses $_ecords, another var (Records, total items a paginar)
	 * @uses $_pager_quantity, another var (Cantidad a paginar, total de items a moistrar por pagina)
	 * @uses $_pager_page, another var (página actual)
	 * @uses $_pager_url, another var (go to url)
	 * @uses $_pager_propagate, another var (go to url)
	 * @return string html con combo de opciones
	 */
	public function paginadoCiego()
	{
		$argumentos = '';
		
		if ($this->_records>'1')
		{
			if(is_array($this->_pager_propagate))
			{
				if(isset($_GET))
				{
					foreach($_GET as $var=> $val)
					{
						if(in_array( $var, $this->_pager_propagate ))
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
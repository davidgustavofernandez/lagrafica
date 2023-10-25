<?php
/**
 * DataType, It takes care of the elements for the form
 * 
 * The DataType Class Generates fields, combos etc.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 3.0
 * @package {SMVC} Simple Model View Controller
 */
/**
 * DataType class, 
 * Return: String Query to inject into the Database
 * @package {SMVC} Simple Model View Controller
 * @subpackage classes
 */
class DataType extends AppAbstractConnectInstance{
    /**
     * _typeArray is the query to try
     * option
     * @access private
     * @var array
     */
    private $_typeArray;
    /**
     * _token is dandom token
     * option
     * @access private
     * @var string
     */
    private $_token;
    /**
     * _result it will be the result
     *
     * @access private
     * @var string
     */
    private $_result;
    /**
     * _colector will be the scripts
     *
     * @access private
     * @var string
     */
    private $_colector;
    /**
     * _isEmpty will be the scripts
     *
     * @access private
     * @var string
     */
    private $_isEmpty = false;
    /**
    * __construct function
     * @see __construct()
     * @uses $_typeArray, typeArray
    */
    /*public function __construct($typeArray)
    {
       if( is_array($typeArray) && !empty($typeArray) )
       {
            $this->_typeArray = $typeArray;
            //$this->_composer();
       }
    }*/
    public function setTypeArray($typeArray)
    {
        if( is_array($typeArray) && !empty($typeArray) )
        {
            $this->_typeArray = $typeArray;
        }
    }
    public function setToken($token)
    {
        if( !empty($token) )
        {
            $this->_token = $token;
        }
    }
    public function setEmpty($isEmpty)
    {
        $this->_isEmpty = $isEmpty;
    }
    /**
     * getColector function
     * 
     * Note: Function that returns the collection of scripts
     * @return string
     */
    public function getColector()
    {
        return $this->_colector;	
    }
    /**
     * _composer function
     * 
     * Note: Function that generates the field dynamically
     * @return string
     */
    public function _composer()
    {
        if ( isset($this->_typeArray['TYPE']) && isset($this->_typeArray['NAME']) && isset($this->_typeArray['ID']) && isset($this->_typeArray['VALUE']))
        {
            if (isset($this->_typeArray['VALUE']))
            {
                foreach ($this->_typeArray['VALUE'] as $valuate)
                {
                    $value = $valuate['VALUE'];
                    $value_name = !empty($valuate['VALUE_NAME']) ? $valuate['VALUE_NAME'] : '';
                    $chequeado = $valuate['CHEQUEADO']=='1' ? ' checked="checked" ' : '';
                    $visible = $valuate['VISIBLE']=='1' ? ' disabled="disabled" ' : '';
                }
            }

            $this->_colector = '';

            switch($this->_typeArray['TYPE'])
            {
                case 'varchar':
                    if(!empty($this->_typeArray['PLACEOLDER']))
                    {
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control varchar" placeholder="' . ucfirst($this->_typeArray['PLACEOLDER']) . '" />';	
                    }else{
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control varchar" />';	
                    }
                break;
                case 'varchartoken':
                    if(!empty($this->_token) && empty($value)){
                        $apply_value = $this->_token;
                    }else{
                        $apply_value = $value;
                    }
                    if(!empty($this->_typeArray['PLACEOLDER']))
                    {
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $apply_value . '" size="50" '.$visible.' class="form-control varchar" placeholder="' . ucfirst($this->_typeArray['PLACEOLDER']) . '" />';    
                    }else{
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $apply_value . '" size="50" '.$visible.' class="form-control varchar" />';   
                    }
                break;
                case 'readonly':
                    if(!empty($this->_typeArray['PLACEOLDER']))
                    {
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control varchar" placeholder="' . ucfirst($this->_typeArray['PLACEOLDER']) . '" readonly />';    
                    }else{
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control varchar" readonly />';   
                    }
                break;
                case 'float':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control varchar" />';	
                break;
                case 'double':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control varchar" />';	
                break;
                case 'varcharlink':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="45" '.$visible.' class="form-control varcharlink" />';	
                break;
                case 'char':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="30" '.$visible.' class="form-control char" />';	
                break;
                case 'checkbox':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . 'XXX" id="' . $this->_typeArray['ID'] . 'XXX" type="checkbox" value="1" class="checkbox" '.$chequeado.' onClick="if(document.'.$this->_typeArray['FORM'].'.'.$this->_typeArray['ID'].'.value==1){document.'.$this->_typeArray['FORM'].'.'.$this->_typeArray['ID'].'.value=\'0\';}else{document.'.$this->_typeArray['FORM'].'.'.$this->_typeArray['ID'].'.value=\'1\'};"/>';	
                    $this->_result .='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="hidden" value="' . $value . '" />';
                break;
                case 'radio':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="radio" value="' . $value . '"'.$chequeado.' class="form-control radio" />';	
                break;
                case 'radioselect':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = $this->_typeArray['KEY'];
                            $chequeado = $retorno[$i]->$key_foraneo==$value ? ' checked="checked" ' : '';
                            $combo .='<input name="' . $this->_typeArray['NAME'] . '" id="'.$retorno[$i]->$key_foraneo.'" type="radio" value="'.$retorno[$i]->$key_foraneo.'"'.$chequeado.' class="form-control radioselect" />';
                            $combo .= htmlentities($retorno[$i]->name) . '<br>';
                        }
                        $combo .= '';
                        $this->_result = $combo;
                    }
                break;
                case 'password':
                    if(!empty($this->_typeArray['PLACEOLDER']))
                    {
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="password" value="' . $value . '" size="50" class="form-control password" placeholder="' . ucfirst($this->_typeArray['PLACEOLDER']) . '" />';
                    }else{
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="password" value="' . $value . '" size="50" class="form-control password" />';
                    }
                break;
                case 'file':
                    $this->_result ='';
                    $this->_colector = '';

                    if(!empty($value))
                    {
                        if(file_exists($this->_typeArray['PATHPHYSICAL'].'thumb/'.$value) || file_exists($this->_typeArray['PATHPHYSICAL'].'small/'.$value) || file_exists($this->_typeArray['PATHPHYSICAL'].'big/'.$value) || file_exists($this->_typeArray['PATHPHYSICAL'].'media/'.$value))
                        {
                            $extencion = explode(".",$value);
                            $extArchivo = '.'.strtolower($extencion[1]);
                            $extImages = array (".jpg", ".jpeg", ".gif", ".png");

                            if(file_exists($this->_typeArray['PATHPHYSICAL'].'thumb/'.$value)){$in_path = 'thumb/';}else if(file_exists($this->_typeArray['PATHPHYSICAL'].'small/'.$value)){$in_path = 'small/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'big/'.$value)){$in_path = 'big/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'media/'.$value)){$in_path = 'media/';}
                            if(file_exists($this->_typeArray['PATHPHYSICAL'].'media/'.$value)){$in_path_big = 'media/';}else if(file_exists($this->_typeArray['PATHPHYSICAL'].'big/'.$value)){$in_path_big = 'big/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'small/'.$value)){$in_path_big = 'small/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'thumb/'.$value)){$in_path_big = 'thumb/';}

                            if( in_array($extArchivo,$extImages) && $in_path == 'thumb/' )
                            {
                                $imagen_mostrar 	= $this->_typeArray['PATHHOST'].$in_path.$value;
                                $imagen_mostrar_pop = $this->_typeArray['PATHHOST'].$in_path_big.$value;
                            }
                            else
                            {
                                $imagen_mostrar 	= CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon_folder/48x48/icon_folder_'.strtolower($extencion[1]).'.gif';
                                $imagen_mostrar_pop	= $this->_typeArray['PATHHOST'].$in_path_big.$value;
                            }
                            $size = getimagesize($this->_typeArray['PATHPHYSICAL'].$in_path.$value);
                            $this->_result .='<div id="img_'.$this->_typeArray['NAME'].'" style="display:block;">';
                            $this->_result .='File cargado:';
                            $this->_result .='<br>';
                            if(empty($imagen_mostrar_pop))
                            {
                                $this->_result .='<img src="'.$imagen_mostrar.'" border="1" style="border-color:#CCCCCC;">';
                            }
                            else
                            {
                                if( in_array($extArchivo,$extImages) )
                                {
                                    $this->_result .='<a href="'.$imagen_mostrar_pop.'" rel="superbox[image]" class="pop_'.$this->_typeArray['NAME'].'"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></a>';
                                    $this->_colector .= $this->magnificPpoUp('pop_'.$this->_typeArray['NAME'].'','image',''.$imagen_mostrar_pop.'');
                                }
                                else
                                {
                                    $this->_result .='<a href="'.$imagen_mostrar_pop.'" rel="superbox[iframe][800x600]" class="pop_'.$this->_typeArray['NAME'].'"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></a>';
                                    $this->_colector .= $this->magnificPpoUp('pop_'.$this->_typeArray['NAME'].'','iframe',''.$imagen_mostrar_pop.'');
                                }
                            }
                            $this->_result .='<br>';
                            $this->_result .= strtoupper(substr(strrchr($value,'.'),1)).' '.$size[0].'px by '.$size[1].'px  ('. number_format( filesize( $this->_typeArray['PATHPHYSICAL'].$in_path.$value )/1024 ,2).' Kb)';
                            $this->_result .='<br />';
                            $this->_result .="<input name=\"borrar_imagen\" id=\"borrar_imagen\" type=\"button\" value=\"Delete\" style=\"width:70px\" class=\"button\" onClick=\"document.getElementById('img_".$this->_typeArray['NAME']."').style.display='none'; document.".$this->_typeArray['TABLE'].".delete_".$this->_typeArray['NAME'].".value='".$value."';\" />";
                            $this->_result .='<input type="hidden" name="delete_'.$this->_typeArray['NAME'].'" id="delete_'.$this->_typeArray['NAME'].'" value="0" />';
                            $this->_result .='</div>';
                            $this->_result .='<br>';
                        }
                    }
                    $this->_result .='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="file" value="' . $value . '" class="form-control file" />';	
                    $this->_result .='<input type="hidden" name="' . $this->_typeArray['NAME'] . '_resize_limit" id="' . $this->_typeArray['NAME'] . '_resize_limit" value="'.$this->_typeArray['FOREIGN_ENTITY'].'" />';	
                break;
                case 'text':
                        $this->_result ='<textarea name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" cols="37" rows="5" size="3" class="form-control text" >' . $value . '</textarea>';	
                break;
                case 'richtext':
                        $this->_colector = $this->ckeditor( $this->_typeArray['NAME'] );
                        $this->_result ='<textarea name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" >' . $value . '</textarea>';
                break;
                case 'richcolor':
                        $this->_colector = $this->richcolor( $this->_typeArray['NAME'] );
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '"  type="text" value="' . $value . '" class="form-control richcolor" />';
                break;
                case 'longtext':
                        $this->_result ='<textarea name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" cols="37" rows="5" size="3" class="form-control longtext" >' . $value . '</textarea>';	
                break;
                case 'hidden':
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="hidden" value="' . $value . '" class="form-control hidden" />';	
                break;
                case 'int':
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" class="form-control int" />';	
                break;
                case 'bigint':
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" class="form-control int" />';	
                break;
                case 'tinyint':
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" class="form-control tinyint" />';	
                break;
                case 'order':
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" '.$visible.' class="form-control order" />';
                break;
                case 'select':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof((array)$retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '<select name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" class="form-control m-b select">'."\n";
                        $combo .= '<option value="0">' . $this->_typeArray['SOBRIQUET'] . '</option>';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            // print_r($retorno[$i]);
                            $key_foraneo    = $this->_typeArray['KEY'];
                            $first_name     = !empty($retorno[$i]->first_name) ? $retorno[$i]->first_name : '';
                            $name           = !empty($retorno[$i]->name) ? $retorno[$i]->name : '';
                            $name           = !empty($name) ? $name : $first_name;
                            $name_patient   = !empty($retorno[$i]->name_patient) ? $retorno[$i]->name_patient : '';
                            $name           = !empty($name) ? $name : $name_patient;

                            $last_name      = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            if($retorno[$i]->$key_foraneo==$value){
                                if(!empty($retorno[$i]->id_setting_country_language))
                                {
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->$key_foraneo.' - '.$name . $last_name . " - ".$retorno[$i]->id_setting_country_language."</option>"."\n";
                                }
                                else
                                {
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->$key_foraneo.' - '.$name . $last_name . "</option>"."\n";
                                }
                            }else{
                                if(!empty($retorno[$i]->id_setting_country_language)){
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->$key_foraneo.' - '.$name . $last_name . " - ".$retorno[$i]->id_setting_country_language."</option>"."\n";
                                }else{
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->$key_foraneo.' - '.$name . $last_name . "</option>"."\n";
                                }
                            }
                        }
                        $combo .= "</select>";
                        $this->_result = $combo;
                    }
                break;
                case 'selectparent':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof((array)$retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '<select name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" class="form-control m-b select">'."\n";
                        $combo .= '<option value="0">' . $this->_typeArray['SOBRIQUET'] . '</option>';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            //print_r($retorno[$i]);
                            $key_foraneo = str_replace('parent_','',$this->_typeArray['KEY']);
                            $key_foraneo = str_replace('equal1_','',$key_foraneo);
                            $key_foraneo = str_replace('equal2_','',$key_foraneo);
                            $key_foraneo = str_replace('equal3_','',$key_foraneo);
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            if($retorno[$i]->$key_foraneo==$value){
                                if(!empty($retorno[$i]->id_setting_country_language)){
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->name . $last_name . " - ".$retorno[$i]->id_setting_country_language."</option>"."\n";
                                }else{
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->name . $last_name . "</option>"."\n";
                                }
                            }else{
                                if(!empty($retorno[$i]->id_setting_country_language)){
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->name . $last_name . " - ".$retorno[$i]->id_setting_country_language."</option>"."\n";
                                }else{
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->name . $last_name . "</option>"."\n";
                                }
                            }
                        }
                        $combo .= "</select>";
                        $this->_result = $combo;
                    }
                break;
                case 'selectequal':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof((array)$retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '<select name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" class="form-control m-b select">'."\n";
                        $combo .= '<option value="0">' . $this->_typeArray['SOBRIQUET'] . '</option>';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            //print_r($retorno[$i]);
                            $key_foraneo = str_replace('equal1_','',$this->_typeArray['KEY']);
                            $key_foraneo = str_replace('equal2_','',$key_foraneo);
                            $key_foraneo = str_replace('equal3_','',$key_foraneo);
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            if($retorno[$i]->$key_foraneo==$value){
                                if(!empty($retorno[$i]->id_setting_country_language)){
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->name . $last_name . " - ".$retorno[$i]->id_setting_country_language."</option>"."\n";
                                }else{
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->name . $last_name . "</option>"."\n";
                                }
                            }else{
                                if(!empty($retorno[$i]->id_setting_country_language)){
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->name . $last_name . " - ".$retorno[$i]->id_setting_country_language."</option>"."\n";
                                }else{
                                    $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->name . $last_name . "</option>"."\n";
                                }
                            }
                        }
                        $combo .= "</select>";
                        $this->_result = $combo;
                    }
                break;
                case 'selectOnChange':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '<select name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" class="form-control m-b select" onchange="javascript:_doController(this.value);"  >'."\n";
                        $combo .= '<option value="0">' . $this->_typeArray['SOBRIQUET'] . '</option>';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = $this->_typeArray['KEY'];
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            if($retorno[$i]->$key_foraneo==$value){
                                $combo .= "<option value='".$retorno[$i]->$key_foraneo."' selected=selected>".$retorno[$i]->name . $last_name . "</option>"."\n";
                            }else{
                                $combo .= "<option value='".$retorno[$i]->$key_foraneo."' >".$retorno[$i]->name . $last_name . "</option>"."\n";
                            }
                        }
                        $combo .= "</select>";
                        $this->_result = $combo;
                    }
                break;
                case 'selectOnChangeJs':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '<select name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" class="form-control m-b selectOnChangeJs" onchange="editoEstado=this.value;this.value=0;' . $this->_typeArray['DO'] . ';"  >'."\n";
                        $combo .= '<option value=\'0\'>' . $this->_typeArray['SOBRIQUET'] . '</option>';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $colorAplicar = $this->_typeArray['ID'] == 'estado' ? "style='color:#FFFFFF; background-color:".$retorno[$i]['color']."; '" : '';
                            if($retorno[$i]['codigo']==$value)
                            {
                                $combo .= "<option value='".$retorno[$i]['codigo']."' selected=selected ".$colorAplicar.">".$retorno[$i]['nombre']."</option>"."\n";
                            }else{
                                $combo .= "<option value='".$retorno[$i]['codigo']."' ".$colorAplicar.">".$retorno[$i]['nombre']."</option>"."\n";
                            }
                        }
                        $combo .= "</select>";
                        $this->_result = $combo;
                    }
                break;
                case 'date':
                    $this->_colector = $this->richCalendarDate( $this->_typeArray['NAME'], $value );
                    // if($value=='' && $this->_isEmpty===false){
                    //     $value = date("Y-m-d");
                    // }
                    $rand = rand(5, 5);
                    $calendario = '';
                    $calendario .= '<input autocomplete="off" type="text" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" class="form-control date" />'."\n";
                    $calendario .= '';
                    $this->_result = $calendario;
                break;
                case 'datetime':
                    $this->_colector = $this->richCalendarDateFull( $this->_typeArray['NAME'], $value );
                    // if($value=='' && $this->_isEmpty===false){
                    //     $value = date("Y-m-d H:i:s");
                    // }
                    $rand = rand(5, 5);
                    $calendario = '';
                    $calendario .= '<input autocomplete="off" type="text" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" class="form-control datetime" />'."\n";
                    $calendario .= '';
                    $this->_result = $calendario;
                break;
                case 'timestamp':
                    // if($value=='' && $this->_isEmpty===false){
                    //     $value = date("Y-m-d H:i:s");
                    // }
                    $rand = rand(5, 5);
                    $calendario = '';
                    $calendario .= '<input autocomplete="off" type="text" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" class="form-control datetime" />'."\n";
                    $calendario .= '<button type="reset" id="' . $this->_typeArray['ID'] . $rand . '" onMouseOver="cargaCalendarioFull(\'' . $this->_typeArray['ID'] . '\',\'' . $this->_typeArray['ID'] . $rand . '\');">...</button>'."\n";
                    $calendario .= '';
                    $this->_result = $calendario;
                break;
                case 'time':
                    $this->_colector = $this->richCalendarTime( $this->_typeArray['NAME'], $value );
                    if($value=='' && $this->_isEmpty===false){
                        $value = date("H:i:s");
                    }
                    $calendario = '<input type="text" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" class="form-control time" />';
                    $this->_result = $calendario;
                break;
                case 'hiddendate':
                    if($value=='' && $this->_isEmpty===false){
                        $value = date("Y-m-d");
                    }
                    $this->_result = '<input type="hidden" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" />'."\n";
                break;
                case 'hiddentime':
                    if($value=='' && $this->_isEmpty===false){
                        $value = date("H:i:s");
                    }
                    $this->_result = '<input type="hidden" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" />';
                break;
                case 'hiddendatetime':
                    if($value=='' && $this->_isEmpty===false){
                        $value = date("Y-m-d H:i:s");
                    }
                    $this->_result = '<input type="hidden" name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" value="' . $value . '" />';
                break;
                case 'multicheckbox':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $default = !empty($this->_typeArray['VALUE']['0']['DAEFAULT']) ? $this->_typeArray['VALUE']['0']['DAEFAULT'] : '';
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            if($retorno[$i]->status>=0)
                            {
                                if(!empty($default))
                                {
                                    $is_cheked = $retorno[$i]->id==$default ? ' checked="checked" ' : '';
                                }
                                else
                                {
                                    $is_cheked = $retorno[$i]->chequeado==1 ? ' checked="checked" ' : '';
                                }

                                $idioma = !empty($retorno[$i]->id_setting_country_language) ? $retorno[$i]->id_setting_country_language : '';

                                $combo .= '<input type="checkbox" name="' . $this->_typeArray['NAME'] . '[]" value="'.$retorno[$i]->id.'" '.$is_cheked.' class="multicheckbox"  /> ';
                                $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                                $combo .= $idioma . ' ' . htmlentities($retorno[$i]->name) . $last_name . '<br>';
                            }
                        }
                        $combo .= '';
                        $this->_result = $combo;
                    }
                    else
                    {
                        $combo = '';
                        $combo .= 'Sin artículos "' . $this->_typeArray['NAME'] . '" cargdos para relacionar asegúrese que haya artículos cargados.';
                        $combo .= '';
                        $this->_result = $combo;
                    }
                break;
                case 'multicheckboxchild':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $default = !empty($this->_typeArray['VALUE']['0']['DAEFAULT']) ? $this->_typeArray['VALUE']['0']['DAEFAULT'] : '';
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $have_parent = !empty($retorno[$i]->parent) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '';

                            if($retorno[$i]->status>=0)
                            {
                                if(!empty($default))
                                {
                                    $is_cheked = $retorno[$i]->id==$default ? ' checked="checked" ' : '';
                                }
                                else
                                {
                                    $is_cheked = $retorno[$i]->chequeado==1 ? ' checked="checked" ' : '';
                                }

                                $idioma = !empty($retorno[$i]->id_setting_country_language) ? $retorno[$i]->id_setting_country_language : '';

                                $combo .= $have_parent.'<input type="checkbox" name="' . $this->_typeArray['NAME'] . '[]" value="'.$retorno[$i]->id.'" '.$is_cheked.' class="multicheckbox"  /> ';
                                $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                                $combo .= $idioma . ' ' . htmlentities($retorno[$i]->name) . $last_name . '<br>';
                            }
                        }
                        $combo .= '';
                        $this->_result = $combo;
                    }
                    else
                    {
                        $combo = '';
                        $combo .= 'Sin artículos "' . $this->_typeArray['NAME'] . '" cargdos para relacionar asegúrese que haya artículos cargados.';
                        $combo .= '';
                        $this->_result = $combo;
                    }
                break;
                case 'url':
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . htmlentities($value) . '" size="50" '.$visible.' class="form-control varchar" />';	
                break;
                case 'seeker':
                    // print_r($this->_typeArray);
                    // echo $valuate['VALUE'].'|'.$chequeado;
                    $this->_colector = $this->seeker( $this->_typeArray['FOREIGN_ENTITY'], 'seeker', $this->_typeArray['NAME'], $this->_typeArray['SERACH_FIELDS'], $this->_typeArray['SERACH_FIELD'] );
                    $combo = '<input id="' . $this->_typeArray['NAME'] . '_'.$this->_typeArray['SERACH_FIELD'].'" name="'.$this->_typeArray['SERACH_FIELD'].'" type="text" class="seeker form-control required" value="'.$value_name.'">';
                    $combo .= '<input id="' . $this->_typeArray['NAME'] . '" name="' . $this->_typeArray['ID'] . '" type="hidden" class="seeker form-control required" value="'.$value.'">';
                    $this->_result = $combo;
                break;
                case 'seekerequal':
                    // print_r($this->_typeArray);
                    // echo $valuate['VALUE'].'|'.$chequeado;
                    // seeker( $controller, $action, $field, $seekers, $field_applay)
                    $this->_colector = $this->seeker( $this->_typeArray['FOREIGN_ENTITY'], 'seeker', $this->_typeArray['NAME'], $this->_typeArray['SERACH_FIELDS'], $this->_typeArray['SERACH_FIELD'] );
                    $combo = '<input id="' . $this->_typeArray['NAME'] . '_'.$this->_typeArray['SERACH_FIELD'].'" name="'.$this->_typeArray['SERACH_FIELD'].'" type="text" class="seeker form-control required" value="'.$value_name.'">';
                    $combo .= '<input id="' . $this->_typeArray['NAME'] . '" name="' . $this->_typeArray['ID'] . '" type="hidden" class="seeker form-control required" value="'.$value.'">';
                    $this->_result = $combo;
                break;
                case 'email':
                    if(!empty($this->_typeArray['PLACEOLDER']))
                    {
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="email" value="' . $value . '" size="50" '.$visible.' class="form-control email" placeholder="' . ucfirst($this->_typeArray['PLACEOLDER']) . '" />';	
                    }else{
                        $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="email" value="' . $value . '" size="50" '.$visible.' class="form-control email" />';	
                    }
                break;
                default:
                    $this->_result ='<input name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" type="text" value="' . $value . '" size="50" maxlength="50"'.$visible.' />';	
                break;
            }
        }else {}	
        return $this->_result;
    }
    /**
     * _show function
     * 
     * Note: Function that generates content view dynamically
     * @return string
     */
    public function _show()
    {
        if ( isset($this->_typeArray['TYPE']) && isset($this->_typeArray['NAME']) && isset($this->_typeArray['ID']) && isset($this->_typeArray['VALUE']))
        {
            if (isset($this->_typeArray['VALUE']))
            {
                foreach ($this->_typeArray['VALUE'] as $valuate)
                {
                    $value = $valuate['VALUE'];
                    $value_name = !empty($valuate['VALUE_NAME']) ? $valuate['VALUE_NAME'] : '';
                    $chequeado = $valuate['CHEQUEADO']=='1' ? ' checked="checked" ' : '';
                    $visible = $valuate['VISIBLE']=='1' ? ' disabled="disabled" ' : '';
                }
            }

            switch($this->_typeArray['TYPE'])
            {
                case 'varchar':			
                    $this->_result = '' . $value . '';	
                break;
                case 'varchartoken':         
                    $this->_result = '' . $value . '';  
                break;
                case 'readonly':
                    $this->_result = '' . $value . '';
                break;
                case 'float':			
                    $this->_result = '' . $value . '';	
                break;
                case 'double':			
                    $this->_result = '' . $value . '';	
                break;
                case 'varcharlink':	
                    $this->_result = $value . ' <a href="' . $value . '" target="_blank">Ver</a>';
                break;
                case 'char':			
                    $this->_result = '' . $value . '';	
                break;
                case 'checkbox':
                    $this->_result = '' . $value . '';	
                break;
                case 'radio':
                    $this->_result = '' . $value . '';	
                break;
                case 'radioselect':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = $this->_typeArray['KEY'];
                            $chequeado = $retorno[$i]->$key_foraneo==$value ? ' checked="checked" ' : '';
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            $combo .='<input name="' . $this->_typeArray['NAME'] . '" id="'.$retorno[$i]->$key_foraneo.'" type="radio" value="'.$retorno[$i]->$key_foraneo.'"'.$chequeado.' class="form-control radioselect" />';
                            $combo .= htmlentities($retorno[$i]->name) . $last_name .'<br>';
                        }
                        $this->_result = $combo;
                    }
                break;
                case 'password':
                    $this->_result = '***********';	
                break;
                case 'file':
                    $this->_result ='';
                    $this->_colector = '';

                    if(!empty($value))
                    {
                        $extencion = explode(".",$value);
                        $extArchivo = '.'.strtolower($extencion[1]);
                        $extImages = array (".jpg", ".jpeg", ".gif", ".png");

                        if(file_exists($this->_typeArray['PATHPHYSICAL'].'thumb/'.$value)){$in_path = 'thumb/';}else if(file_exists($this->_typeArray['PATHPHYSICAL'].'small/'.$value)){$in_path = 'small/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'big/'.$value)){$in_path = 'big/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'media/'.$value)){$in_path = 'media/';}
                        if(file_exists($this->_typeArray['PATHPHYSICAL'].'media/'.$value)){$in_path_big = 'media/';}else if(file_exists($this->_typeArray['PATHPHYSICAL'].'big/'.$value)){$in_path_big = 'big/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'small/'.$value)){$in_path_big = 'small/';}elseif(file_exists($this->_typeArray['PATHPHYSICAL'].'thumb/'.$value)){$in_path_big = 'thumb/';}

                        if( in_array($extArchivo,$extImages) && $in_path == 'thumb/' )
                        {
                            $imagen_mostrar = $this->_typeArray['PATHHOST'].$in_path.$value;
                            $imagen_mostrar_pop = $this->_typeArray['PATHHOST'].$in_path_big.$value;
                        }
                        else
                        {
                            $imagen_mostrar = CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.'skin/'.TEMPLATE_SKIN_BACKEND.'/images/icon_folder/48x48/icon_folder_'.strtolower($extencion[1]).'.gif';
                            $imagen_mostrar_pop = $this->_typeArray['PATHHOST'].$in_path_big.$value;
                        }

                        $size = getimagesize($this->_typeArray['PATHPHYSICAL'].$in_path.$value);
                        $this->_result .='File cargado:';
                        $this->_result .='<br>';
                        if(empty($imagen_mostrar_pop))
                        {
                            $this->_result .='<img src="'.$imagen_mostrar.'" border="1" style="border-color:#CCCCCC;">';
                        }
                        else
                        {
                            if( in_array($extArchivo,$extImages) )
                            {
                                $this->_result .='<a href="'.$imagen_mostrar_pop.'" rel="superbox[image]"  class="pop_'.$this->_typeArray['NAME'].'"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></a>';
                                $this->_colector .= $this->magnificPpoUp('pop_'.$this->_typeArray['NAME'].'','iframe',''.$imagen_mostrar_pop.'');
                            }
                            else
                            {
                                $this->_result .='<a href="'.$imagen_mostrar_pop.'" rel="superbox[iframe][800x600]" class="pop_'.$this->_typeArray['NAME'].'"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></a>';
                                $this->_colector .= $this->magnificPpoUp('pop_'.$this->_typeArray['NAME'].'','iframe',''.$imagen_mostrar_pop.'');
                            }
                        }
                        $this->_result .='<br>';
                        $this->_result .= strtoupper(substr(strrchr($value,'.'),1)).' '.$size[0].'px by '.$size[1].'px  ('. number_format( filesize( $this->_typeArray['PATHPHYSICAL'].$in_path.$value )/1024 ,2).' Kb)';
                    }
                    $this->_result .='';
                break;
                case 'text':
                    $this->_result = '' . $value . '';		
                break;
                case 'richtext':
                    $this->_result = '' . $value . '';	
                break;
                case 'richcolor':
                    $this->_result = '' . $value . '';	
                break;
                case 'longtext':
                    $this->_result = '' . $value . '';	
                break;
                case 'hidden':
                    //
                break;
                case 'int':
                    $this->_result = '' . $value . '';		
                break;
                case 'bigint':
                    $this->_result = '' . $value . '';		
                break;
                case 'tinyint':
                    $this->_result = '' . $value . '';		
                break;
                case 'order':
                    $this->_result = '' . $value . '';	
                break;
                case 'select':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = $this->_typeArray['KEY'];
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            $first_name     = !empty($retorno[$i]->first_name) ? $retorno[$i]->first_name : '';
                            $name           = !empty($retorno[$i]->name) ? $retorno[$i]->name : '';
                            $name           = !empty($name) ? $name : $first_name;
                            $name_patient   = !empty($retorno[$i]->name_patient) ? $retorno[$i]->name_patient : '';
                            $name           = !empty($name) ? $name : $name_patient;
                            if($retorno[$i]->$key_foraneo==$value){
                                $combo .= '<font style="color:#f00;">'. $key_foraneo . ' - ' . $name . $last_name.'</font><br>';
                            }
                        }
                        $combo .= "";
                        $this->_result = $combo;
                    }
                break;
                case 'selectparent':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = str_replace('parent_','',$this->_typeArray['KEY']);
                            $key_foraneo = str_replace('equal1_','',$key_foraneo);
                            $key_foraneo = str_replace('equal2_','',$key_foraneo);
                            $key_foraneo = str_replace('equal3_','',$key_foraneo);
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            $first_name     = !empty($retorno[$i]->first_name) ? $retorno[$i]->first_name : '';
                            $name           = !empty($retorno[$i]->name) ? $retorno[$i]->name : '';
                            $name           = !empty($name) ? $name : $first_name;

                            if($retorno[$i]->$key_foraneo==$value){
                                $combo .= '<font style="color:#f00;">'. $name . $last_name.'</font><br>';
                            }
                        }
                        $combo .= "";
                        $this->_result = $combo;
                    }
                break;
                case 'selectequal':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = str_replace('equal1_','',$this->_typeArray['KEY']);
                            $key_foraneo = str_replace('equal2_','',$key_foraneo);
                            $key_foraneo = str_replace('equal3_','',$key_foraneo);
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            $first_name     = !empty($retorno[$i]->first_name) ? $retorno[$i]->first_name : '';
                            $name           = !empty($retorno[$i]->name) ? $retorno[$i]->name : '';
                            $name           = !empty($name) ? $name : $first_name;

                            if($retorno[$i]->$key_foraneo==$value){
                                $combo .= '<font style="color:#f00;">'. $name . $last_name.'</font><br>';
                            }
                        }
                        $combo .= "";
                        $this->_result = $combo;
                    }
                break;
                case 'selectOnChange':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $key_foraneo = $this->_typeArray['KEY'];
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            if($retorno[$i]->$key_foraneo==$value){
                                $combo .= '<font style="color:#f00;">'. $retorno[$i]->name . $last_name.'</font><br>';
                            }
                        }
                        $combo .= "";
                        $this->_result = $combo;
                    }
                break;
                case 'selectOnChangeJs':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '<select name="' . $this->_typeArray['NAME'] . '" id="' . $this->_typeArray['ID'] . '" class="form-control m-b selectOnChangeJs" onchange="editoEstado=this.value;this.value=0;' . $this->_typeArray['DO'] . ';"  >'."\n";
                        $combo .= '<option value=\'0\'>' . $this->_typeArray['SOBRIQUET'] . '</option>';

                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $colorAplicar = $this->_typeArray['ID'] == 'estado' ? "style='color:#FFFFFF; background-color:".$retorno[$i]['color']."; '" : '';
                            if($retorno[$i]['codigo']==$value)
                            {
                                $combo .= "<option value='".$retorno[$i]['codigo']."' selected=selected ".$colorAplicar.">".$retorno[$i]['nombre']."</option>"."\n";
                            }else{
                                $combo .= "<option value='".$retorno[$i]['codigo']."' ".$colorAplicar.">".$retorno[$i]['nombre']."</option>"."\n";
                            }
                        }
                        $combo .= "</select>";
                        $this->_result = $combo;
                    }
                break;
                case 'date':
                    $this->_result = '' . $value . '';	
                break;
                case 'datetime':
                    $this->_result = '' . $value . '';	
                break;
                case 'timestamp':
                    $this->_result = '' . $value . '';	
                break;
                case 'time':
                    $this->_result = '' . $value . '';	
                break;
                case 'hiddendate':
                    //
                break;
                case 'hiddentime':
                    //
                break;
                case 'hiddendatetime':
                    //
                break;
                case 'multicheckbox':

                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $is_cheked = $retorno[$i]->chequeado==1 ? ' checked="checked" ' : '';
                            $combo .= '<input type="checkbox" name="' . $this->_typeArray['NAME'] . '[]" value="'.$retorno[$i]->id.'" '.$is_cheked.' class="multicheckbox"  /> ';
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            $combo .= $retorno[$i]->id.' ' . htmlentities($retorno[$i]->name) . $last_name . '<br>';
                        }
                        $combo .= '';
                        $this->_result = $combo;
                    }
                break;
                case 'multicheckboxchild':

                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) )
                    {
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++) //loop de los campos
                        {
                            $have_parent = !empty($retorno[$i]->parent) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '';
                            $is_cheked = $retorno[$i]->chequeado==1 ? ' checked="checked" ' : '';
                            $combo .= $have_parent.'<input type="checkbox" name="' . $this->_typeArray['NAME'] . '[]" value="'.$retorno[$i]->id.'" '.$is_cheked.' class="multicheckbox"  /> ';
                            $last_name = !empty($retorno[$i]->last_name) ? ' '.htmlentities($retorno[$i]->last_name) : '';
                            $combo .= $retorno[$i]->id.' ' . htmlentities($retorno[$i]->name) . $last_name . '<br>';
                        }
                        $combo .= '';
                        $this->_result = $combo;
                    }
                break;
                case 'url':			
                    $this->_result = '<a href="' . htmlentities($value) . '" target="_blank">' . htmlentities($value) . '</a>';	
                break;
                case 'seeker':
                    $combo = '<font style="color:#f00;">'. $value_name .'</font><br>';
                    $this->_result = $combo;
                break;
                case 'seekerequal':
                    $combo = '<font style="color:#f00;">'. $value_name .'</font><br>';
                    $this->_result = $combo;
                break;
                case 'email':			
                    $this->_result = '' . $value . '';	
                break;
                default:
                    //
                break;
            }
        }else{}	
        return $this->_result;
    }

    /**
     * _show function
     * 
     * Note: Function that generates content view dynamically
     * @return string
     */
    public function _direct(){
        if ( isset($this->_typeArray['TYPE']) && isset($this->_typeArray['NAME']) && isset($this->_typeArray['ID']) && isset($this->_typeArray['VALUE'])){
            if (isset($this->_typeArray['VALUE'])){
                foreach ($this->_typeArray['VALUE'] as $valuate){
                    $value = $valuate['VALUE'];
                    $value_name = !empty($valuate['VALUE_NAME']) ? $valuate['VALUE_NAME'] : '';
                    $chequeado = $valuate['CHEQUEADO']=='1' ? ' checked="checked" ' : '';
                    $visible = $valuate['VISIBLE']=='1' ? ' disabled="disabled" ' : '';
                }
            }

            switch($this->_typeArray['TYPE']){
                case 'varchar':			
                    $this->_result = $value;	
                break;
                case 'varchartoken':         
                    $this->_result = $value;    
                break;
                case 'readonly':
                    $this->_result = $value;
                break;
                case 'varcharlink':	
                    $this->_result = $value . ' <a href="' . $value . '" target="_blank">Ver</a>';	
                break;
                case 'char':			
                    $this->_result = $value;	
                break;
                case 'checkbox':
                    $this->_result = $value;	
                break;
                case 'radio':
                    $this->_result = $value;	
                break;
                case 'radioselect':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) ){
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++){
                            $key_foraneo = $this->_typeArray['KEY'];
                            $combo .= htmlentities($retorno[$i]->name);
                        }
                        $this->_result = $combo;
                    }
                break;
                case 'password':
                    $this->_result = '***********';	
                break;
                case 'file':
                    $this->_result = $value;	
                break;
                case 'text':
                    $this->_result = $value;	
                break;
                case 'richtext':
                    $this->_result = $value;	
                break;
                case 'richcolor':
                    $this->_result = $value;	
                break;
                case 'longtext':
                    $this->_result = $value;	
                break;
                case 'hidden':
                    //
                break;
                case 'int':
                    $this->_result = $value;		
                break;
                case 'bigint':
                    $this->_result = $value;		
                break;
                case 'tinyint':
                    $this->_result = $value;		
                break;
                case 'order':
                    $this->_result = $value;	
                break;
                case 'select':
                    $this->_result = $value;
                break;
                case 'selectparent':
                    $this->_result = $value;
                break;
                case 'date':
                    $this->_result = $value;	
                break;
                case 'datetime':
                    $this->_result = $value;	
                break;
                case 'timestamp':
                    $this->_result = $value;	
                break;
                case 'time':
                    $this->_result = $value;	
                break;
                case 'hiddendate':
                    //
                break;
                case 'hiddentime':
                    //
                break;
                case 'hiddendatetime':
                    //
                break;
                case 'multicheckbox':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) ){
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++){
                            $is_cheked = $retorno[$i]->chequeado==1 ? ' checked="checked" ' : '';
                            $combo .= htmlentities($retorno[$i]->name);
                        }
                        $this->_result = $combo;
                    }
                break;
                case 'multicheckboxchild':
                    $retorno = $this->_typeArray['QUERY_PREPARED'];
                    $lengDatos = sizeof($retorno);

                    if( is_array($retorno) ){
                        $combo = '';
                        for ($i=0; $i<$lengDatos; $i++){
                            $is_cheked = $retorno[$i]->chequeado==1 ? ' checked="checked" ' : '';
                            $combo .= htmlentities($retorno[$i]->name);
                        }
                        $this->_result = $combo;
                    }
                break;
                case 'url':			
                    $this->_result = '<a href="' . $value . '" target="_blank">' . $value . '</a>';	
                break;
                case 'email':			
                    $this->_result = $value;	
                break;
                default:
                    $this->_result = $value;
                break;
            }
        }else{}
        
        return $this->_result;
    }
    public function richCalendarDate( $campo, $date ){
        $retorno = "
        $('#".$campo."').datetimepicker({
            // startDate:'+".$date."',
            timepicker:false,
            format:'Y-m-d'
        });";
        return $retorno;
    }
    public function richCalendarDateFull( $campo, $date ){
        $retorno = "
        $('#".$campo."').datetimepicker({
            // startDate:'+".$date."',
            format:'Y-m-d H:i:i'
        });";
        return $retorno;
    }
    public function richCalendarTime( $campo, $date ){
        $retorno = "
        $('#".$campo."').datetimepicker({
            // startDate:'+".$date."',
            datepicker:false,
            format:'H:i:i'
        });";
        return $retorno;
    }
    public function richcolor( $campo ){
        $retorno = "
            $('#".$campo."').ColorPicker({
                color: '#ff0000',
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val('#'+hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                },
                onChange: function (hsb, hex, rgb) {
                    $('#".$campo."').val('#'+hex);
                }
            })
            .bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
        ";
        return $retorno;
    }
    public function cleditor( $campo ){
        $retorno = "	
          $(document).ready(function() {
            $('#".$campo."').cleditor();
          });
        ";
        return $retorno;
    }
    public function ckeditor( $campo ){
      $retorno = "	
      $( document ).ready( function() {
        $( '#".$campo."' ).ckeditor();
      } );
      ";
      return $retorno;
    }
    public function ckeditorNew( $campo ){
        $retorno = "    
        $( document ).ready( function() {
            ClassicEditor
                .create( document.querySelector( '#".$campo."' ), {
                    toolbar: [ 'heading', '|', 'bold', '|', 'italic', '|', 'blockquote', '|', 'link','|', 'undo', 'redo' ],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading3' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading4' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading5' },
                            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading6' }
                        ]
                    }
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( err => {
                    console.error( err.stack );
                } );
        } );
        ";
        return $retorno;
    }
    public function seeker( $controller, $action, $field, $seekers, $field_applay){
        $retorno = "
        // console.log(fields);
        $('#".$field."_".$field_applay."').autocomplete({
            paramName: 'search',
            minChars: 3,
            serviceUrl: '".CONFIG_HOST_NAME_BACKEND."index.php?controller=".$controller."&action=".$action."&search_on=".$seekers."',
            onSelect: function (suggestion) {
                console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
                $('#".$field."').val(suggestion.data);
            },
            onSearchError: function (query, jqXHR, textStatus, errorThrown) {
            }
        });
        ";
        return $retorno;
    }
    private function _sinSalto($txt){
        $txt = str_replace("\r","", $txt);
        $txt = str_replace("\n"," ", $txt);

        return $txt;
    }
    private function _formateaFecha($f, $s){
        list( $y, $m, $d  ) = split( '[/.-]', $f );
        return $d.$s.$m.$s.$y;
    }
    private function _formateaFechaEsp($f, $s){
        list( $y, $m, $d  ) = split( '[/.-]', $f );
        return $y.$s.$m.$s.$d;
    }
    public function magnificPpoUp( $campo, $type, $path ){
        if($type=='image'){
            $retorno = "
                $(document).ready(function() {
                    $('.".$campo."').magnificPopup({
                        items: {
                          src: '".$path."'
                        },
                        type: 'image'
                    });
                });
            ";
        }else{
            $retorno = "
                $(document).ready(function() {
                    $('.".$campo."').magnificPopup({
                        items: {
                          src: '".$path."'
                        },
                        type: 'inline'
                    });
                });
            ";
        }
        return $retorno;
    }
    /**
     * @see __destruct()
     */
    public function __destruct(){
        //unset($this);
    }
}
?>
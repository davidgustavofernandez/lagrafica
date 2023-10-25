<?php
/**
 * startModel, Model "base"
 * 
 * The startModel class is the model to mediate between the controller and the view by applying the model. Extends the connection instance, Interact with the DB.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 * @subpackage Controller
 */
class startModel extends AppAbstractConnectInstance{
    public function getStructureDatabase(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);

        $path = dirname(__FILE__).'/../_lib/database/structure/data.inc';

        // Is the bbdd cached?
        if(file_exists($path)){
          $estructura_bbdd = unserialize(file_get_contents($path));
          // Exist
          if( !array_key_exists(CONFIG_DB_NAME, $estructura_bbdd) ){
            // The Database does not match the one in the cache. Delete the cache database
            $estructura_bbdd = $cl->getDatabaseDump(true);
          }
        }else{ 
            // NO exist;
            $estructura_bbdd = $cl->getDatabaseDump(true);
        }
        
        return $estructura_bbdd;
    }
    /**
     * getInjection public function
     * Note: Inject a query directly into the database. Use to inject code directly
     */
    public function getInjection($query){
        if(!empty($query)){
            $cl = new QueryMethods();
            $cl->setConn($this->_conn);
            $resultSelect = $cl->injection($query);
            $estadoSelect = $cl->state();

            return $resultSelect;
        }else{
            return 'error';
        }
    }

    public function setMenu($menu_state){
      $menu_config = array($menu_state);
      $this->_ses->setSessionInit(CONFIG_SESION_FLAG);
      $this->_ses->setSessionVariableArray('admin_menu_state', $menu_config);
    }

    # Errors Log
    public function getErrorsList(){
      $directory = dirname(__FILE__) .'/../_lib/handler/log';
      $files  = array_diff(scandir($directory), array('..', '.'));
      if(is_array($files)){
        return $files;
      }else{
        return array('');
      }
    }
    public function getErrorsFileLittering($file){
      $file = str_replace('\\','',str_replace('/','',$file));
      $file = dirname(__FILE__) .'/../_lib/handler/log/'.$file;
      if (file_exists($file)) {
        @unlink($file);
        $returned = true;
      }else{
        $returned = false;
      }
      return $returned;
    }
    public function getEraseAllErrors(){
      $directory = dirname(__FILE__) .'/../_lib/handler/log/';
      $scanned_directory = array_diff(scandir($directory), array('..', '.'));
      foreach($scanned_directory as $files){
        $file = $directory.$files;
        if (file_exists($file)) {
          @unlink($file);
        }
      }
    }

    # Events Log
    public function getEventsList(){
      $directory = dirname(__FILE__) .'/../../material/_events';
      $files  = array_diff(scandir($directory), array('..', '.'));
      if(is_array($files)){
        return $files;
      }else{
        return array('');
      }
    }
    public function getEventsFileLittering($file){
      $file = str_replace('\\','',str_replace('/','',$file));
      $file = dirname(__FILE__) .'/../../material/_events/'.$file;
      if (file_exists($file)) {
        @unlink($file);
        $returned = true;
      }else{
        $returned = false;
      }
      return $returned;
    }
    public function getEraseAllEvents(){
      $directory = dirname(__FILE__) .'/../../material/_events/';
      $scanned_directory = array_diff(scandir($directory), array('..', '.'));
      foreach($scanned_directory as $files){
        $file = $directory.$files;
        if (file_exists($file)) {
          @unlink($file);
        }
      }
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
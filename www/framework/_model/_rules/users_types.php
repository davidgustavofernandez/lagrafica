<?php
/**
 * Rules, Set of rules
 * 
 * Function set the rules for this controller
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (09/08/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Rules class,
 * @subpackage Rules
 */
class Rules{
    private $_items = array();
    private $_querys = array();
    private $_rules = array();
    private $_prefix = '';
    /**
     * setPrefix function
     * Note: Prefix of the tables
     */
    public function setPrefix($prefix){
        $this->_prefix = $prefix;
    }
    /**
     * getRules function
     * Note: Returns a query Array
     */
    public function getRules(){
        $this->_setItems();
        $this->_setQuerys();
        $this->_factory();

        return $this->_rules;
    }
    /**
     * _setItems function
     * Note: Array of tables
     */
    private function _setItems(){
        $this->_items = array(
        'tablas' => array(
                array(
                    'relacion' => 'user_type_permission',
                    'tabla_a' => $this->_prefix.'users_types_permissions',
                    'tabla_b' => $this->_prefix.'users_types_permissions_relations',
                    'tabla_c' => $this->_prefix.'users_types',
                    'id_a' => 'id_user_type_permission',
                    'id_b' => 'id_user_type_permission_relation',
                    'id_c' => 'id_user_type',
                    'id_filtro' => 'id_user_type'
                )
            )
        );
    }
    /**
     * _setQuerys function
     * Note: Query Array apply
     */
    private function _setQuerys(){
        $this->_querys = array(
            'edit' => 'SELECT p.[id_a] as id,p.name,(CASE WHEN ap.[id_a] is null then 0 else 1 end ) as chequeado, p.status FROM [tabla_a] p LEFT JOIN [tabla_b] ap on ap.[id_a] = p.[id_a] AND ap.[id_c]="[[id_c]]" AND ap.status="1" AND p.status="1" order by p.field_order',
            // 'create' => 'SELECT distinct(p.[id_a]) as id, p.name, 0 chequeado, p.status FROM [tabla_a] p LEFT JOIN [tabla_b] ap on ap.[id_a] = p.[id_a] WHERE p.status="1" order by p.field_order',
            'create' => 'SELECT p.[id_a] as id, p.name, 0 chequeado, p.status FROM [tabla_a] p LEFT JOIN [tabla_b] ap on ap.[id_a] = p.[id_a] WHERE p.status="1" order by p.field_order',
            //'preview' => 'SELECT p.[id_a] as id, p.name,(CASE WHEN ap.[id_a] is null then 0 else 1 end ) as chequeado, p.status FROM [tabla_a] p LEFT JOIN [tabla_b] ap ON ap.[id_a] = p.[id_a] AND ap.[id_c]="[[id_c]]" WHERE p.[id_a]="[[id_a]]" AND p.status="1" ',
            'preview' => 'SELECT p.[id_a] as id, p.name,(CASE WHEN ap.[id_a] is null then 0 else 1 end ) as chequeado, p.status FROM [tabla_a] p LEFT JOIN [tabla_b] ap on ap.[id_a] = p.[id_a] AND ap.[id_c]="[[id_c]]" AND ap.status="1" AND p.status="1" GROUP BY p.[id_a] order by p.field_order',
            'borra' => 'DELETE FROM [tabla_b] WHERE [id_c]="[[id_c]]" ',
            'inserta' => "INSERT INTO [tabla_b] ([id_c],[id_a],status) values ('[[id_c]]','[[id_a]]','1')",
            'update' => "INSERT INTO [tabla_b] ([id_c],[id_a],status) values ('[[id_c]]','[[id_a]]','1')"
      );
    }
    /**
     * _factory function
     * Note: Generates the final Array
     */
    private function _factory(){
        $final = array();

        foreach($this->_items['tablas'] as $tablas){
            $final[$tablas['relacion']] = array(
                'tabla_a' => $tablas['tabla_a'],
                'tabla_b' => $tablas['tabla_b'],
                'tabla_c' => $tablas['tabla_c'],
                'id_a' => $tablas['id_a'],
                'id_b' => $tablas['id_b'],
                'id_c' => $tablas['id_c'],
                'id_filtro' => $tablas['id_filtro'],
                'edit' => str_replace('[tabla_a]', $tablas['tabla_a'],str_replace('[tabla_b]', $tablas['tabla_b'],str_replace('[tabla_c]', $tablas['tabla_c'], str_replace('[id_a]', $tablas['id_a'],str_replace('[id_b]', $tablas['id_b'],str_replace('[id_c]', $tablas['id_c'], $this->_querys['edit'])))))),
                'create' => str_replace('[tabla_a]', $tablas['tabla_a'],str_replace('[tabla_b]', $tablas['tabla_b'],str_replace('[tabla_c]', $tablas['tabla_c'], str_replace('[id_a]', $tablas['id_a'],str_replace('[id_b]', $tablas['id_b'],str_replace('[id_c]', $tablas['id_c'], $this->_querys['create'])))))),
                'preview' => str_replace('[tabla_a]', $tablas['tabla_a'],str_replace('[tabla_b]', $tablas['tabla_b'],str_replace('[tabla_c]', $tablas['tabla_c'], str_replace('[id_a]', $tablas['id_a'],str_replace('[id_b]', $tablas['id_b'],str_replace('[id_c]', $tablas['id_c'], $this->_querys['preview'])))))),
                'borra' => str_replace('[tabla_a]', $tablas['tabla_a'],str_replace('[tabla_b]', $tablas['tabla_b'],str_replace('[tabla_c]', $tablas['tabla_c'], str_replace('[id_a]', $tablas['id_a'],str_replace('[id_b]', $tablas['id_b'],str_replace('[id_c]', $tablas['id_c'], $this->_querys['borra'])))))),
                'inserta' => str_replace('[tabla_a]', $tablas['tabla_a'],str_replace('[tabla_b]', $tablas['tabla_b'],str_replace('[tabla_c]', $tablas['tabla_c'], str_replace('[id_a]', $tablas['id_a'],str_replace('[id_b]', $tablas['id_b'],str_replace('[id_c]', $tablas['id_c'], $this->_querys['inserta'])))))),
                'update' => str_replace('[tabla_a]', $tablas['tabla_a'],str_replace('[tabla_b]', $tablas['tabla_b'],str_replace('[tabla_c]', $tablas['tabla_c'], str_replace('[id_a]', $tablas['id_a'],str_replace('[id_b]', $tablas['id_b'],str_replace('[id_c]', $tablas['id_c'], $this->_querys['update']))))))
           );
        }
        $this->_rules = $final;
    }
}
/*
$rules = new Rules();
$retorno = $rules->getRules();
print_r($retorno);
*/
?>
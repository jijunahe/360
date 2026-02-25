<?php
/**
 * Table Definition for lime_preguntaxdimension_642991
 */

class DataObjects_LimePreguntaxdimension642991 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_preguntaxdimension_642991';    // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_codigo;                          // string(100)  
    public $_pregunta;                        // string(200)  
    public $_promedio;                        // real(11)  
    public $_dimension;                       // string(100)  
    public $_idDimension;                     // int(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimePreguntaxdimension642991',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'codigo' =>  DB_DATAOBJECT_STR,
             'pregunta' =>  DB_DATAOBJECT_STR,
             'promedio' =>  DB_DATAOBJECT_INT,
             'dimension' =>  DB_DATAOBJECT_STR,
             'idDimension' =>  DB_DATAOBJECT_INT,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'codigo' => '',
             'pregunta' => '',
             'dimension' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

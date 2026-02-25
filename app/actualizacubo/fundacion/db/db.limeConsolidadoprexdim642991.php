<?php
/**
 * Table Definition for lime_consolidadoprexdim_642991
 */

class DataObjects_LimeConsolidadoprexdim642991 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_consolidadoprexdim_642991';    // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_codigoPregunta;                  // string(50)  
    public $_respuesta;                       // string(200)  
    public $_codPreguntacruzar;               // string(50)  
    public $_dimension;                       // string(50)  
    public $_promedio;                        // real(32)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeConsolidadoprexdim642991',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'codigoPregunta' =>  DB_DATAOBJECT_STR,
             'respuesta' =>  DB_DATAOBJECT_STR,
             'codPreguntacruzar' =>  DB_DATAOBJECT_STR,
             'dimension' =>  DB_DATAOBJECT_STR,
             'promedio' =>  DB_DATAOBJECT_INT,
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
             'codigoPregunta' => '',
             'respuesta' => '',
             'codPreguntacruzar' => '',
             'dimension' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

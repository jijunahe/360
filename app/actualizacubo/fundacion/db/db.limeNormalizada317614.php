<?php
/**
 * Table Definition for lime_normalizada_317614
 */

class DataObjects_LimeNormalizada317614 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_normalizada_317614';         // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_idEncuesta;                      // int(12)  
    public $_anw_id;                          // int(12)  multiple_key
    public $_anw_submitdate;                  // datetime(19)  binary
    public $_anw_lastpage;                    // int(12)  
    public $_anw_startlanguage;               // string(20)  
    public $_anw_ipaddr;                      // string(50)  
    public $_anw_refurl;                      // int(200)  
    public $_respuesta;                       // string(500)  
    public $_codigopregunta;                  // string(100)  
    public $_qid;                             // int(12)  
    public $_idPreg;                          // int(12)  
    public $_nombregrupo;                     // string(500)  
    public $_pregunta;                        // string(500)  
    public $_codigoRespuesta;                 // string(100)  
    public $_nombreEncuesta;                  // string(500)  
    public $_valorEscala;                     // int(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeNormalizada317614',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idEncuesta' =>  DB_DATAOBJECT_INT,
             'anw_id' =>  DB_DATAOBJECT_INT,
             'anw_submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'anw_lastpage' =>  DB_DATAOBJECT_INT,
             'anw_startlanguage' =>  DB_DATAOBJECT_STR,
             'anw_ipaddr' =>  DB_DATAOBJECT_STR,
             'anw_refurl' =>  DB_DATAOBJECT_INT,
             'respuesta' =>  DB_DATAOBJECT_STR,
             'codigopregunta' =>  DB_DATAOBJECT_STR,
             'qid' =>  DB_DATAOBJECT_INT,
             'idPreg' =>  DB_DATAOBJECT_INT,
             'nombregrupo' =>  DB_DATAOBJECT_STR,
             'pregunta' =>  DB_DATAOBJECT_STR,
             'codigoRespuesta' =>  DB_DATAOBJECT_STR,
             'nombreEncuesta' =>  DB_DATAOBJECT_STR,
             'valorEscala' =>  DB_DATAOBJECT_INT,
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
             'anw_startlanguage' => '',
             'anw_ipaddr' => '',
             'respuesta' => '',
             'codigopregunta' => '',
             'nombregrupo' => '',
             'pregunta' => '',
             'codigoRespuesta' => '',
             'nombreEncuesta' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

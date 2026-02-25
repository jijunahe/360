<?php
/**
 * Table Definition for view_riesgo_transformada
 */

class DataObjects_ViewRiesgoTransformada extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'view_riesgo_transformada';        // table name
    public $_anw_id;                          // int(12)  
    public $_anw_submitdate;                  // datetime(19)  binary
    public $_respuesta;                       // string(1500)  
    public $_codigopregunta;                  // string(300)  
    public $_qid;                             // int(12)  
    public $_idPreg;                          // int(12)  
    public $_nombregrupo;                     // string(1500)  
    public $_pregunta;                        // string(1500)  
    public $_codigoRespuesta;                 // string(300)  
    public $_nombreEncuesta;                  // string(1500)  
    public $_valorEscala;                     // int(12)  
    public $_submitdate;                      // datetime(19)  binary
    public $_317614X32X698;                   // string(150)  
    public $_317614X32X699;                   // string(150)  
    public $_317614X32X700;                   // string(150)  
    public $_317614X32X701;                   // string(150)  
    public $_317614X32X702;                   // string(150)  
    public $_317614X32X703;                   // string(150)  
    public $_317614X32X704;                   // string(150)  
    public $_317614X32X705;                   // string(150)  
    public $_317614X32X706;                   // string(150)  
    public $_317614X32X707;                   // string(150)  
    public $_317614X32X708;                   // string(150)  
    public $_317614X32X709;                   // string(150)  
    public $_317614X32X710;                   // string(150)  
    public $_317614X32X711;                   // string(150)  
    public $_317614X32X712;                   // string(150)  
    public $_317614X32X713;                   // string(150)  
    public $_317614X32X714;                   // string(150)  
    public $_317614X32X715;                   // string(150)  
    public $_317614X32X716;                   // string(150)  
    public $_317614X32X717;                   // string(150)  
    public $_317614X32X718;                   // string(150)  
    public $_317614X32X719;                   // string(150)  
    public $_317614X32X720;                   // string(150)  
    public $_317614X32X721;                   // string(150)  
    public $_317614X32X722;                   // string(150)  
    public $_317614X32X723;                   // string(150)  
    public $_317614X32X724;                   // string(150)  
    public $_mor10aniosT;                     // string(30)  
    public $_mor10aniosCo;                    // string(30)  
    public $_mor10aniosNoCo;                  // string(30)  
    public $_riesgoFramingham;                // string(30)  
    public $_riesgo;                          // string(60)  
    public $_modificadoProcam;                // string(30)  
    public $_rangoedad;                       // string(150)  
    public $_indice;                          // string(30)  
    public $_estadoCorporal;                  // string(300)  
    public $_encuesta;                        // string(600)  
    public $_idEncuesta;                      // string(60)  
    public $_idAnswer;                        // int(12)  
    public $_id;                              // int(12)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_ViewRiesgoTransformada',$k,$v); }

    function table()
    {
         return array(
             'anw_id' =>  DB_DATAOBJECT_INT,
             'anw_submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'respuesta' =>  DB_DATAOBJECT_STR,
             'codigopregunta' =>  DB_DATAOBJECT_STR,
             'qid' =>  DB_DATAOBJECT_INT,
             'idPreg' =>  DB_DATAOBJECT_INT,
             'nombregrupo' =>  DB_DATAOBJECT_STR,
             'pregunta' =>  DB_DATAOBJECT_STR,
             'codigoRespuesta' =>  DB_DATAOBJECT_STR,
             'nombreEncuesta' =>  DB_DATAOBJECT_STR,
             'valorEscala' =>  DB_DATAOBJECT_INT,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             '317614X32X698' =>  DB_DATAOBJECT_STR,
             '317614X32X699' =>  DB_DATAOBJECT_STR,
             '317614X32X700' =>  DB_DATAOBJECT_STR,
             '317614X32X701' =>  DB_DATAOBJECT_STR,
             '317614X32X702' =>  DB_DATAOBJECT_STR,
             '317614X32X703' =>  DB_DATAOBJECT_STR,
             '317614X32X704' =>  DB_DATAOBJECT_STR,
             '317614X32X705' =>  DB_DATAOBJECT_STR,
             '317614X32X706' =>  DB_DATAOBJECT_STR,
             '317614X32X707' =>  DB_DATAOBJECT_STR,
             '317614X32X708' =>  DB_DATAOBJECT_STR,
             '317614X32X709' =>  DB_DATAOBJECT_STR,
             '317614X32X710' =>  DB_DATAOBJECT_STR,
             '317614X32X711' =>  DB_DATAOBJECT_STR,
             '317614X32X712' =>  DB_DATAOBJECT_STR,
             '317614X32X713' =>  DB_DATAOBJECT_STR,
             '317614X32X714' =>  DB_DATAOBJECT_STR,
             '317614X32X715' =>  DB_DATAOBJECT_STR,
             '317614X32X716' =>  DB_DATAOBJECT_STR,
             '317614X32X717' =>  DB_DATAOBJECT_STR,
             '317614X32X718' =>  DB_DATAOBJECT_STR,
             '317614X32X719' =>  DB_DATAOBJECT_STR,
             '317614X32X720' =>  DB_DATAOBJECT_STR,
             '317614X32X721' =>  DB_DATAOBJECT_STR,
             '317614X32X722' =>  DB_DATAOBJECT_STR,
             '317614X32X723' =>  DB_DATAOBJECT_STR,
             '317614X32X724' =>  DB_DATAOBJECT_STR,
             'mor10aniosT' =>  DB_DATAOBJECT_STR,
             'mor10aniosCo' =>  DB_DATAOBJECT_STR,
             'mor10aniosNoCo' =>  DB_DATAOBJECT_STR,
             'riesgoFramingham' =>  DB_DATAOBJECT_STR,
             'riesgo' =>  DB_DATAOBJECT_STR,
             'modificadoProcam' =>  DB_DATAOBJECT_STR,
             'rangoedad' =>  DB_DATAOBJECT_STR,
             'indice' =>  DB_DATAOBJECT_STR,
             'estadoCorporal' =>  DB_DATAOBJECT_STR,
             'encuesta' =>  DB_DATAOBJECT_STR,
             'idEncuesta' =>  DB_DATAOBJECT_STR,
             'idAnswer' =>  DB_DATAOBJECT_INT,
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array();
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'respuesta' => '',
             'codigopregunta' => '',
             'nombregrupo' => '',
             'pregunta' => '',
             'codigoRespuesta' => '',
             'nombreEncuesta' => '',
             '317614X32X698' => '',
             '317614X32X699' => '',
             '317614X32X700' => '',
             '317614X32X701' => '',
             '317614X32X702' => '',
             '317614X32X703' => '',
             '317614X32X704' => '',
             '317614X32X705' => '',
             '317614X32X706' => '',
             '317614X32X707' => '',
             '317614X32X708' => '',
             '317614X32X709' => '',
             '317614X32X710' => '',
             '317614X32X711' => '',
             '317614X32X712' => '',
             '317614X32X713' => '',
             '317614X32X714' => '',
             '317614X32X715' => '',
             '317614X32X716' => '',
             '317614X32X717' => '',
             '317614X32X718' => '',
             '317614X32X719' => '',
             '317614X32X720' => '',
             '317614X32X721' => '',
             '317614X32X722' => '',
             '317614X32X723' => '',
             '317614X32X724' => '',
             'mor10aniosT' => '',
             'mor10aniosCo' => '',
             'mor10aniosNoCo' => '',
             'riesgoFramingham' => '',
             'riesgo' => '',
             'modificadoProcam' => '',
             'rangoedad' => '',
             'indice' => '',
             'estadoCorporal' => '',
             'encuesta' => '',
             'idEncuesta' => '',
             'id' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

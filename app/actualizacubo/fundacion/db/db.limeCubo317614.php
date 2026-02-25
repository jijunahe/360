<?php
/**
 * Table Definition for lime_cubo_317614
 */

class DataObjects_LimeCubo317614 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_cubo_317614';                // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_token;                           // string(50)  
    public $_submitdate;                      // date(10)  binary
    public $_lastpage;                        // string(50)  
    public $_startlanguage;                   // string(50)  
    public $_startdate;                       // string(50)  
    public $_datestamp;                       // string(50)  
    public $_ipaddr;                          // string(50)  
    public $_317614X32X698;                   // string(50)  
    public $_317614X32X699;                   // string(50)  
    public $_317614X32X700;                   // string(50)  
    public $_317614X32X701;                   // string(50)  
    public $_317614X32X702;                   // string(50)  
    public $_317614X32X703;                   // string(50)  
    public $_317614X32X704;                   // string(50)  
    public $_317614X32X705;                   // string(50)  
    public $_317614X32X706;                   // string(50)  
    public $_317614X32X707;                   // string(50)  
    public $_317614X32X708;                   // string(50)  
    public $_317614X32X709;                   // string(50)  
    public $_317614X32X710;                   // string(50)  
    public $_317614X32X711;                   // string(50)  
    public $_317614X32X712;                   // string(50)  
    public $_317614X32X713;                   // string(50)  
    public $_317614X32X714;                   // string(50)  
    public $_317614X32X715;                   // string(50)  
    public $_317614X32X716;                   // string(50)  
    public $_317614X32X717;                   // string(50)  
    public $_317614X32X718;                   // string(50)  
    public $_317614X32X719;                   // string(50)  
    public $_317614X32X720;                   // string(50)  
    public $_317614X32X721;                   // string(50)  
    public $_317614X32X722;                   // string(50)  
    public $_317614X32X723;                   // string(50)  
    public $_317614X32X724;                   // string(50)  
    public $_317614X32X727;                   // string(50)  
    public $_317614X32X728;                   // string(50)  
    public $_317614X32X733;                   // string(200)  
    public $_317614X32X734;                   // string(2)  
    public $_317614X32X735;                   // string(2)  
    public $_317614X32X736;                   // string(2)  
    public $_317614X32X737;                   // string(2)  
    public $_317614X32X738;                   // string(2)  
    public $_317614X32X739;                   // string(2)  
    public $_317614X32X740;                   // string(2)  
    public $_317614X32X741;                   // string(200)  
    public $_317614X32X742;                   // string(200)  
    public $_317614X32X744;                   // string(200)  
    public $_317614X32X748;                   // string(200)  
    public $_317614X32X747;                   // string(200)  
    public $_317614X32X746;                   // string(200)  
    public $_317614X32X749;                   // string(200)  
    public $_riesgo;                          // string(20)  
    public $_mor10aniosT;                     // string(10)  
    public $_mor10aniosCo;                    // string(10)  
    public $_mor10aniosNoCo;                  // string(10)  
    public $_riesgoFramingham;                // string(10)  
    public $_modificadoProcam;                // string(10)  
    public $_rangoedad;                       // string(50)  
    public $_indice;                          // string(10)  
    public $_estadoCorporal;                  // string(100)  
    public $_encuesta;                        // string(200)  
    public $_idEncuesta;                      // string(20)  
    public $_idAnswer;                        // int(12)  
    public $_riesgom;                         // string(20)  
    public $_rangoScore;                      // string(20)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeCubo317614',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'token' =>  DB_DATAOBJECT_STR,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE,
             'lastpage' =>  DB_DATAOBJECT_STR,
             'startlanguage' =>  DB_DATAOBJECT_STR,
             'startdate' =>  DB_DATAOBJECT_STR,
             'datestamp' =>  DB_DATAOBJECT_STR,
             'ipaddr' =>  DB_DATAOBJECT_STR,
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
             '317614X32X727' =>  DB_DATAOBJECT_STR,
             '317614X32X728' =>  DB_DATAOBJECT_STR,
             '317614X32X733' =>  DB_DATAOBJECT_STR,
             '317614X32X734' =>  DB_DATAOBJECT_STR,
             '317614X32X735' =>  DB_DATAOBJECT_STR,
             '317614X32X736' =>  DB_DATAOBJECT_STR,
             '317614X32X737' =>  DB_DATAOBJECT_STR,
             '317614X32X738' =>  DB_DATAOBJECT_STR,
             '317614X32X739' =>  DB_DATAOBJECT_STR,
             '317614X32X740' =>  DB_DATAOBJECT_STR,
             '317614X32X741' =>  DB_DATAOBJECT_STR,
             '317614X32X742' =>  DB_DATAOBJECT_STR,
             '317614X32X744' =>  DB_DATAOBJECT_STR,
             '317614X32X748' =>  DB_DATAOBJECT_STR,
             '317614X32X747' =>  DB_DATAOBJECT_STR,
             '317614X32X746' =>  DB_DATAOBJECT_STR,
             '317614X32X749' =>  DB_DATAOBJECT_STR,
             'riesgo' =>  DB_DATAOBJECT_STR,
             'mor10aniosT' =>  DB_DATAOBJECT_STR,
             'mor10aniosCo' =>  DB_DATAOBJECT_STR,
             'mor10aniosNoCo' =>  DB_DATAOBJECT_STR,
             'riesgoFramingham' =>  DB_DATAOBJECT_STR,
             'modificadoProcam' =>  DB_DATAOBJECT_STR,
             'rangoedad' =>  DB_DATAOBJECT_STR,
             'indice' =>  DB_DATAOBJECT_STR,
             'estadoCorporal' =>  DB_DATAOBJECT_STR,
             'encuesta' =>  DB_DATAOBJECT_STR,
             'idEncuesta' =>  DB_DATAOBJECT_STR,
             'idAnswer' =>  DB_DATAOBJECT_INT,
             'riesgom' =>  DB_DATAOBJECT_STR,
             'rangoScore' =>  DB_DATAOBJECT_STR,
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
             'token' => '',
             'lastpage' => '',
             'startlanguage' => '',
             'startdate' => '',
             'datestamp' => '',
             'ipaddr' => '',
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
             '317614X32X727' => '',
             '317614X32X728' => '',
             '317614X32X733' => '',
             '317614X32X734' => '',
             '317614X32X735' => '',
             '317614X32X736' => '',
             '317614X32X737' => '',
             '317614X32X738' => '',
             '317614X32X739' => '',
             '317614X32X740' => '',
             '317614X32X741' => '',
             '317614X32X742' => '',
             '317614X32X744' => '',
             '317614X32X748' => '',
             '317614X32X747' => '',
             '317614X32X746' => '',
             '317614X32X749' => '',
             'riesgo' => '',
             'mor10aniosT' => '',
             'mor10aniosCo' => '',
             'mor10aniosNoCo' => '',
             'riesgoFramingham' => '',
             'modificadoProcam' => '',
             'rangoedad' => '',
             'indice' => '',
             'estadoCorporal' => '',
             'encuesta' => '',
             'idEncuesta' => '',
             'riesgom' => '',
             'rangoScore' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

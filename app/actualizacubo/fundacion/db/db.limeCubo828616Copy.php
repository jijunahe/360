<?php
/**
 * Table Definition for lime_cubo_828616_copy
 */

class DataObjects_LimeCubo828616Copy extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_cubo_828616_copy';           // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_token;                           // string(50)  
    public $_submitdate;                      // datetime(19)  binary
    public $_lastpage;                        // string(50)  
    public $_startlanguage;                   // string(50)  
    public $_startdate;                       // string(50)  
    public $_datestamp;                       // string(50)  
    public $_ipaddr;                          // string(50)  
    public $_828616X27X665;                   // string(50)  
    public $_828616X27X661;                   // string(50)  
    public $_828616X27X663;                   // string(50)  
    public $_828616X27X664;                   // string(50)  
    public $_828616X27X658;                   // string(50)  
    public $_828616X27X666;                   // string(50)  
    public $_828616X27X659;                   // string(50)  
    public $_828616X27X668;                   // string(50)  
    public $_828616X28X669;                   // string(50)  
    public $_828616X28X670;                   // string(50)  
    public $_828616X28X671;                   // string(50)  
    public $_828616X28X672;                   // string(50)  
    public $_828616X29X673;                   // string(50)  
    public $_828616X29X674;                   // string(50)  
    public $_828616X29X675;                   // string(50)  
    public $_828616X29X676;                   // string(50)  
    public $_828616X29X677;                   // string(50)  
    public $_828616X29X678;                   // string(50)  
    public $_828616X29X679;                   // string(50)  
    public $_828616X29X680;                   // string(50)  
    public $_828616X30X682;                   // string(50)  
    public $_828616X30X683;                   // string(50)  
    public $_828616X30X684;                   // string(50)  
    public $_828616X30X685;                   // string(50)  
    public $_828616X30X686;                   // string(50)  
    public $_828616X30X687;                   // string(50)  
    public $_828616X30X688;                   // string(50)  
    public $_828616X31X690;                   // string(50)  
    public $_828616X31X691;                   // string(50)  
    public $_828616X31X692;                   // string(50)  
    public $_828616X31X693;                   // string(50)  
    public $_828616X31X694;                   // string(50)  
    public $_828616X31X695;                   // string(50)  
    public $_828616X31X696;                   // string(50)  
    public $_rangoedad;                       // string(50)  
    public $_indice;                          // string(10)  
    public $_estadoCorporal;                  // string(100)  
    public $_encuesta;                        // string(200)  
    public $_idEncuesta;                      // string(20)  
    public $_idAnswer;                        // int(12)  
    public $_828616X29X725;                   // string(1)  
    public $_828616X27X730;                   // string(255)  not_null
    public $_828616X27X731;                   // string(255)  
    public $_828616X27X732;                   // string(255)  
    public $_828616X27X743;                   // string(255)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeCubo828616Copy',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'token' =>  DB_DATAOBJECT_STR,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'lastpage' =>  DB_DATAOBJECT_STR,
             'startlanguage' =>  DB_DATAOBJECT_STR,
             'startdate' =>  DB_DATAOBJECT_STR,
             'datestamp' =>  DB_DATAOBJECT_STR,
             'ipaddr' =>  DB_DATAOBJECT_STR,
             '828616X27X665' =>  DB_DATAOBJECT_STR,
             '828616X27X661' =>  DB_DATAOBJECT_STR,
             '828616X27X663' =>  DB_DATAOBJECT_STR,
             '828616X27X664' =>  DB_DATAOBJECT_STR,
             '828616X27X658' =>  DB_DATAOBJECT_STR,
             '828616X27X666' =>  DB_DATAOBJECT_STR,
             '828616X27X659' =>  DB_DATAOBJECT_STR,
             '828616X27X668' =>  DB_DATAOBJECT_STR,
             '828616X28X669' =>  DB_DATAOBJECT_STR,
             '828616X28X670' =>  DB_DATAOBJECT_STR,
             '828616X28X671' =>  DB_DATAOBJECT_STR,
             '828616X28X672' =>  DB_DATAOBJECT_STR,
             '828616X29X673' =>  DB_DATAOBJECT_STR,
             '828616X29X674' =>  DB_DATAOBJECT_STR,
             '828616X29X675' =>  DB_DATAOBJECT_STR,
             '828616X29X676' =>  DB_DATAOBJECT_STR,
             '828616X29X677' =>  DB_DATAOBJECT_STR,
             '828616X29X678' =>  DB_DATAOBJECT_STR,
             '828616X29X679' =>  DB_DATAOBJECT_STR,
             '828616X29X680' =>  DB_DATAOBJECT_STR,
             '828616X30X682' =>  DB_DATAOBJECT_STR,
             '828616X30X683' =>  DB_DATAOBJECT_STR,
             '828616X30X684' =>  DB_DATAOBJECT_STR,
             '828616X30X685' =>  DB_DATAOBJECT_STR,
             '828616X30X686' =>  DB_DATAOBJECT_STR,
             '828616X30X687' =>  DB_DATAOBJECT_STR,
             '828616X30X688' =>  DB_DATAOBJECT_STR,
             '828616X31X690' =>  DB_DATAOBJECT_STR,
             '828616X31X691' =>  DB_DATAOBJECT_STR,
             '828616X31X692' =>  DB_DATAOBJECT_STR,
             '828616X31X693' =>  DB_DATAOBJECT_STR,
             '828616X31X694' =>  DB_DATAOBJECT_STR,
             '828616X31X695' =>  DB_DATAOBJECT_STR,
             '828616X31X696' =>  DB_DATAOBJECT_STR,
             'rangoedad' =>  DB_DATAOBJECT_STR,
             'indice' =>  DB_DATAOBJECT_STR,
             'estadoCorporal' =>  DB_DATAOBJECT_STR,
             'encuesta' =>  DB_DATAOBJECT_STR,
             'idEncuesta' =>  DB_DATAOBJECT_STR,
             'idAnswer' =>  DB_DATAOBJECT_INT,
             '828616X29X725' =>  DB_DATAOBJECT_STR,
             '828616X27X730' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             '828616X27X731' =>  DB_DATAOBJECT_STR,
             '828616X27X732' =>  DB_DATAOBJECT_STR,
             '828616X27X743' =>  DB_DATAOBJECT_STR,
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
             '828616X27X665' => '',
             '828616X27X661' => '',
             '828616X27X663' => '',
             '828616X27X664' => '',
             '828616X27X658' => '',
             '828616X27X666' => '',
             '828616X27X659' => '',
             '828616X27X668' => '',
             '828616X28X669' => '',
             '828616X28X670' => '',
             '828616X28X671' => '',
             '828616X28X672' => '',
             '828616X29X673' => '',
             '828616X29X674' => '',
             '828616X29X675' => '',
             '828616X29X676' => '',
             '828616X29X677' => '',
             '828616X29X678' => '',
             '828616X29X679' => '',
             '828616X29X680' => '',
             '828616X30X682' => '',
             '828616X30X683' => '',
             '828616X30X684' => '',
             '828616X30X685' => '',
             '828616X30X686' => '',
             '828616X30X687' => '',
             '828616X30X688' => '',
             '828616X31X690' => '',
             '828616X31X691' => '',
             '828616X31X692' => '',
             '828616X31X693' => '',
             '828616X31X694' => '',
             '828616X31X695' => '',
             '828616X31X696' => '',
             'rangoedad' => '',
             'indice' => '',
             'estadoCorporal' => '',
             'encuesta' => '',
             'idEncuesta' => '',
             '828616X29X725' => '',
             '828616X27X730' => '',
             '828616X27X731' => '',
             '828616X27X732' => '',
             '828616X27X743' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

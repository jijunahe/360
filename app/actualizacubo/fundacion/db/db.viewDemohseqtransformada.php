<?php
/**
 * Table Definition for view_demohseqtransformada
 */

class DataObjects_ViewDemohseqtransformada extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'view_demohseqtransformada';       // table name
    public $_token;                           // string(150)  
    public $_submitdate;                      // datetime(19)  binary
    public $_lastpage;                        // string(150)  
    public $_startlanguage;                   // string(150)  
    public $_startdate;                       // string(150)  
    public $_hora;                            // string(2)  
    public $_datestamp;                       // string(150)  
    public $_ipaddr;                          // string(150)  
    public $_828616X27X665;                   // string(150)  
    public $_828616X27X661;                   // string(150)  
    public $_828616X27X663;                   // string(150)  
    public $_828616X27X664;                   // string(150)  
    public $_828616X27X658;                   // string(150)  
    public $_828616X27X666;                   // string(150)  
    public $_828616X27X659;                   // string(150)  
    public $_828616X27X668;                   // string(150)  
    public $_828616X28X669;                   // string(150)  
    public $_828616X28X670;                   // string(150)  
    public $_828616X28X671;                   // string(150)  
    public $_828616X28X672;                   // string(150)  
    public $_828616X29X673;                   // string(150)  
    public $_828616X29X674;                   // string(150)  
    public $_828616X29X675;                   // string(150)  
    public $_828616X29X676;                   // string(150)  
    public $_828616X29X677;                   // string(150)  
    public $_828616X29X678;                   // string(150)  
    public $_828616X29X679;                   // string(150)  
    public $_828616X29X680;                   // string(150)  
    public $_828616X30X682;                   // string(150)  
    public $_828616X30X683;                   // string(150)  
    public $_828616X30X684;                   // string(150)  
    public $_828616X30X685;                   // string(150)  
    public $_828616X30X686;                   // string(150)  
    public $_828616X30X687;                   // string(150)  
    public $_828616X30X688;                   // string(150)  
    public $_828616X31X690;                   // string(150)  
    public $_828616X31X691;                   // string(150)  
    public $_828616X31X692;                   // string(150)  
    public $_828616X31X693;                   // string(150)  
    public $_828616X31X694;                   // string(150)  
    public $_828616X31X695;                   // string(150)  
    public $_828616X31X696;                   // string(150)  
    public $_indice;                          // string(30)  
    public $_estadoCorporal;                  // string(300)  
    public $_encuesta;                        // string(600)  
    public $_idAnswer;                        // int(12)  
    public $_id;                              // int(12)  not_null
    public $_idEncuesta;                      // int(12)  
    public $_anw_id;                          // int(12)  
    public $_anw_submitdate;                  // datetime(19)  binary
    public $_anw_lastpage;                    // int(12)  
    public $_anw_startlanguage;               // string(60)  
    public $_anw_ipaddr;                      // string(150)  
    public $_anw_refurl;                      // int(200)  
    public $_respuesta;                       // string(1500)  
    public $_codigopregunta;                  // string(300)  
    public $_qid;                             // int(12)  
    public $_idPreg;                          // int(12)  
    public $_nombregrupo;                     // string(1500)  
    public $_pregunta;                        // string(1500)  
    public $_codigoRespuesta;                 // string(300)  
    public $_nombreEncuesta;                  // string(1500)  
    public $_valorEscala;                     // int(12)  
    public $_rangoedad;                       // string(150)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_ViewDemohseqtransformada',$k,$v); }

    function table()
    {
         return array(
             'token' =>  DB_DATAOBJECT_STR,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'lastpage' =>  DB_DATAOBJECT_STR,
             'startlanguage' =>  DB_DATAOBJECT_STR,
             'startdate' =>  DB_DATAOBJECT_STR,
             'hora' =>  DB_DATAOBJECT_STR,
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
             'indice' =>  DB_DATAOBJECT_STR,
             'estadoCorporal' =>  DB_DATAOBJECT_STR,
             'encuesta' =>  DB_DATAOBJECT_STR,
             'idAnswer' =>  DB_DATAOBJECT_INT,
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
             'rangoedad' =>  DB_DATAOBJECT_STR,
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
             'token' => '',
             'lastpage' => '',
             'startlanguage' => '',
             'startdate' => '',
             'hora' => '',
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
             'indice' => '',
             'estadoCorporal' => '',
             'encuesta' => '',
             'id' => 0,
             'anw_startlanguage' => '',
             'anw_ipaddr' => '',
             'respuesta' => '',
             'codigopregunta' => '',
             'nombregrupo' => '',
             'pregunta' => '',
             'codigoRespuesta' => '',
             'nombreEncuesta' => '',
             'rangoedad' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

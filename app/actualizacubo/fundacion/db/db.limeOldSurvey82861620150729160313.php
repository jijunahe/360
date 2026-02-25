<?php
/**
 * Table Definition for lime_old_survey_828616_20150729160313
 */

class DataObjects_LimeOldSurvey82861620150729160313 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_old_survey_828616_20150729160313';    // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_token;                           // string(36)  multiple_key
    public $_submitdate;                      // datetime(19)  binary
    public $_lastpage;                        // int(11)  
    public $_startlanguage;                   // string(20)  not_null
    public $_828616X27X665;                   // blob(65535)  blob
    public $_828616X27X661;                   // string(1)  
    public $_828616X27X663;                   // blob(65535)  blob
    public $_828616X27X664;                   // datetime(19)  binary
    public $_828616X27X658;                   // real(32)  
    public $_828616X27X666;                   // real(32)  
    public $_828616X27X659;                   // real(32)  
    public $_828616X27X668;                   // string(5)  
    public $_828616X28X669;                   // string(1)  
    public $_828616X28X670;                   // string(1)  
    public $_828616X28X671;                   // string(1)  
    public $_828616X28X672;                   // string(1)  
    public $_828616X29X673;                   // string(1)  
    public $_828616X29X674;                   // string(5)  
    public $_828616X29X675;                   // string(5)  
    public $_828616X29X676;                   // string(1)  
    public $_828616X29X677;                   // string(1)  
    public $_828616X29X678;                   // string(1)  
    public $_828616X29X679;                   // string(1)  
    public $_828616X29X680;                   // string(1)  
    public $_828616X29X681;                   // string(1)  
    public $_828616X30X682;                   // string(1)  
    public $_828616X30X683;                   // string(5)  
    public $_828616X30X684;                   // string(1)  
    public $_828616X30X685;                   // string(1)  
    public $_828616X30X686;                   // string(1)  
    public $_828616X30X687;                   // string(5)  
    public $_828616X30X688;                   // blob(65535)  blob
    public $_828616X30X689;                   // string(1)  
    public $_828616X31X690;                   // string(1)  
    public $_828616X31X691;                   // string(5)  
    public $_828616X31X692;                   // string(1)  
    public $_828616X31X693;                   // string(1)  
    public $_828616X31X694;                   // string(1)  
    public $_828616X31X695;                   // string(1)  
    public $_828616X31X696;                   // string(1)  
    public $_828616X31X697;                   // string(1)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeOldSurvey82861620150729160313',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'token' =>  DB_DATAOBJECT_STR,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'lastpage' =>  DB_DATAOBJECT_INT,
             'startlanguage' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             '828616X27X665' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '828616X27X661' =>  DB_DATAOBJECT_STR,
             '828616X27X663' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '828616X27X664' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             '828616X27X658' =>  DB_DATAOBJECT_INT,
             '828616X27X666' =>  DB_DATAOBJECT_INT,
             '828616X27X659' =>  DB_DATAOBJECT_INT,
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
             '828616X29X681' =>  DB_DATAOBJECT_STR,
             '828616X30X682' =>  DB_DATAOBJECT_STR,
             '828616X30X683' =>  DB_DATAOBJECT_STR,
             '828616X30X684' =>  DB_DATAOBJECT_STR,
             '828616X30X685' =>  DB_DATAOBJECT_STR,
             '828616X30X686' =>  DB_DATAOBJECT_STR,
             '828616X30X687' =>  DB_DATAOBJECT_STR,
             '828616X30X688' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '828616X30X689' =>  DB_DATAOBJECT_STR,
             '828616X31X690' =>  DB_DATAOBJECT_STR,
             '828616X31X691' =>  DB_DATAOBJECT_STR,
             '828616X31X692' =>  DB_DATAOBJECT_STR,
             '828616X31X693' =>  DB_DATAOBJECT_STR,
             '828616X31X694' =>  DB_DATAOBJECT_STR,
             '828616X31X695' =>  DB_DATAOBJECT_STR,
             '828616X31X696' =>  DB_DATAOBJECT_STR,
             '828616X31X697' =>  DB_DATAOBJECT_STR,
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
             'startlanguage' => '',
             '828616X27X665' => '',
             '828616X27X661' => '',
             '828616X27X663' => '',
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
             '828616X29X681' => '',
             '828616X30X682' => '',
             '828616X30X683' => '',
             '828616X30X684' => '',
             '828616X30X685' => '',
             '828616X30X686' => '',
             '828616X30X687' => '',
             '828616X30X688' => '',
             '828616X30X689' => '',
             '828616X31X690' => '',
             '828616X31X691' => '',
             '828616X31X692' => '',
             '828616X31X693' => '',
             '828616X31X694' => '',
             '828616X31X695' => '',
             '828616X31X696' => '',
             '828616X31X697' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

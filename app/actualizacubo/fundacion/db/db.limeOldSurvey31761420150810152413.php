<?php
/**
 * Table Definition for lime_old_survey_317614_20150810152413
 */

class DataObjects_LimeOldSurvey31761420150810152413 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_old_survey_317614_20150810152413';    // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_token;                           // string(36)  multiple_key
    public $_submitdate;                      // datetime(19)  binary
    public $_lastpage;                        // int(11)  
    public $_startlanguage;                   // string(20)  not_null
    public $_startdate;                       // datetime(19)  not_null binary
    public $_datestamp;                       // datetime(19)  not_null binary
    public $_ipaddr;                          // blob(65535)  blob
    public $_317614X32X698;                   // datetime(19)  binary
    public $_317614X32X699;                   // blob(65535)  blob
    public $_317614X32X700;                   // real(32)  
    public $_317614X32X701;                   // real(32)  
    public $_317614X32X702;                   // string(1)  
    public $_317614X32X703;                   // datetime(19)  binary
    public $_317614X32X704;                   // string(1)  
    public $_317614X32X705;                   // real(32)  
    public $_317614X32X706;                   // real(32)  
    public $_317614X32X707;                   // real(32)  
    public $_317614X32X708;                   // real(32)  
    public $_317614X32X709;                   // real(32)  
    public $_317614X32X710;                   // real(32)  
    public $_317614X32X711;                   // real(32)  
    public $_317614X32X712;                   // real(32)  
    public $_317614X32X713;                   // real(32)  
    public $_317614X32X714;                   // string(1)  
    public $_317614X32X715;                   // real(32)  
    public $_317614X32X716;                   // real(32)  
    public $_317614X32X717;                   // string(5)  
    public $_317614X32X718;                   // string(5)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeOldSurvey31761420150810152413',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'token' =>  DB_DATAOBJECT_STR,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'lastpage' =>  DB_DATAOBJECT_INT,
             'startlanguage' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'startdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'datestamp' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'ipaddr' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '317614X32X698' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             '317614X32X699' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '317614X32X700' =>  DB_DATAOBJECT_INT,
             '317614X32X701' =>  DB_DATAOBJECT_INT,
             '317614X32X702' =>  DB_DATAOBJECT_STR,
             '317614X32X703' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             '317614X32X704' =>  DB_DATAOBJECT_STR,
             '317614X32X705' =>  DB_DATAOBJECT_INT,
             '317614X32X706' =>  DB_DATAOBJECT_INT,
             '317614X32X707' =>  DB_DATAOBJECT_INT,
             '317614X32X708' =>  DB_DATAOBJECT_INT,
             '317614X32X709' =>  DB_DATAOBJECT_INT,
             '317614X32X710' =>  DB_DATAOBJECT_INT,
             '317614X32X711' =>  DB_DATAOBJECT_INT,
             '317614X32X712' =>  DB_DATAOBJECT_INT,
             '317614X32X713' =>  DB_DATAOBJECT_INT,
             '317614X32X714' =>  DB_DATAOBJECT_STR,
             '317614X32X715' =>  DB_DATAOBJECT_INT,
             '317614X32X716' =>  DB_DATAOBJECT_INT,
             '317614X32X717' =>  DB_DATAOBJECT_STR,
             '317614X32X718' =>  DB_DATAOBJECT_STR,
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
             'ipaddr' => '',
             '317614X32X699' => '',
             '317614X32X702' => '',
             '317614X32X704' => '',
             '317614X32X714' => '',
             '317614X32X717' => '',
             '317614X32X718' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

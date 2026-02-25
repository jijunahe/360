<?php
/**
 * Table Definition for lime_survey_317614
 */

class DataObjects_LimeSurvey317614 extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_survey_317614';              // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_token;                           // string(36)  multiple_key
    public $_submitdate;                      // datetime(19)  binary
    public $_lastpage;                        // int(11)  
    public $_startlanguage;                   // string(20)  not_null
    public $_startdate;                       // datetime(19)  not_null binary
    public $_datestamp;                       // datetime(19)  not_null binary
    public $_ipaddr;                          // blob(65535)  blob
    public $_317614X32X699;                   // blob(65535)  blob
    public $_317614X32X700;                   // real(32)  
    public $_317614X32X701;                   // real(32)  
    public $_317614X32X702;                   // string(1)  
    public $_317614X32X703;                   // datetime(19)  binary
    public $_317614X32X705;                   // real(32)  
    public $_317614X32X706;                   // real(32)  
    public $_317614X32X707;                   // real(32)  
    public $_317614X32X710;                   // real(32)  
    public $_317614X32X711;                   // real(32)  
    public $_317614X32X712;                   // real(32)  
    public $_317614X32X713;                   // real(32)  
    public $_317614X32X704;                   // string(1)  
    public $_317614X32X714;                   // string(1)  
    public $_317614X32X715;                   // blob(65535)  blob
    public $_317614X32X716;                   // real(32)  
    public $_317614X32X719;                   // string(1)  
    public $_317614X32X720;                   // string(5)  
    public $_317614X32X727;                   // real(32)  
    public $_317614X32X728;                   // real(32)  
    public $_317614X32X733;                   // string(1)  
    public $_317614X32X721;                   // string(5)  
    public $_317614X32X723;                   // string(1)  
    public $_317614X32X734;                   // string(1)  
    public $_317614X32X735;                   // string(1)  
    public $_317614X32X736;                   // string(1)  
    public $_317614X32X737;                   // string(1)  
    public $_317614X32X738;                   // string(1)  
    public $_317614X32X739;                   // string(1)  
    public $_317614X32X740;                   // string(1)  
    public $_317614X32X741;
    public $_317614X32X742;                   // string(200)  
    public $_317614X32X744;                   // string(200)  
    public $_317614X32X748;                   // string(200)  
    public $_317614X32X747;                   // string(200)  
    public $_317614X32X746;                   // string(200)  
    public $_317614X32X749;                   // string(200)  
	
	// blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurvey317614',$k,$v); }

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
             '317614X32X699' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '317614X32X700' =>  DB_DATAOBJECT_INT,
             '317614X32X701' =>  DB_DATAOBJECT_INT,
             '317614X32X702' =>  DB_DATAOBJECT_STR,
             '317614X32X703' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             '317614X32X705' =>  DB_DATAOBJECT_INT,
             '317614X32X706' =>  DB_DATAOBJECT_INT,
             '317614X32X707' =>  DB_DATAOBJECT_INT,
             '317614X32X710' =>  DB_DATAOBJECT_INT,
             '317614X32X711' =>  DB_DATAOBJECT_INT,
             '317614X32X712' =>  DB_DATAOBJECT_INT,
             '317614X32X713' =>  DB_DATAOBJECT_INT,
             '317614X32X704' =>  DB_DATAOBJECT_STR,
             '317614X32X714' =>  DB_DATAOBJECT_STR,
             '317614X32X715' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '317614X32X716' =>  DB_DATAOBJECT_INT,
             '317614X32X719' =>  DB_DATAOBJECT_STR,
             '317614X32X720' =>  DB_DATAOBJECT_STR,
             '317614X32X727' =>  DB_DATAOBJECT_INT,
             '317614X32X728' =>  DB_DATAOBJECT_INT,
             '317614X32X733' =>  DB_DATAOBJECT_STR,
             '317614X32X721' =>  DB_DATAOBJECT_STR,
             '317614X32X723' =>  DB_DATAOBJECT_STR,
             '317614X32X734' =>  DB_DATAOBJECT_STR,
             '317614X32X735' =>  DB_DATAOBJECT_STR,
             '317614X32X736' =>  DB_DATAOBJECT_STR,
             '317614X32X737' =>  DB_DATAOBJECT_STR,
             '317614X32X738' =>  DB_DATAOBJECT_STR,
             '317614X32X739' =>  DB_DATAOBJECT_STR,
             '317614X32X740' =>  DB_DATAOBJECT_STR,
             '317614X32X741' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '317614X32X742' =>  DB_DATAOBJECT_STR,
             '317614X32X744' =>  DB_DATAOBJECT_STR,
             '317614X32X748' =>  DB_DATAOBJECT_STR,
             '317614X32X747' =>  DB_DATAOBJECT_STR,
             '317614X32X746' =>  DB_DATAOBJECT_STR,
             '317614X32X749' =>  DB_DATAOBJECT_STR,
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
             '317614X32X715' => '',
             '317614X32X719' => '',
             '317614X32X720' => '',
             '317614X32X733' => '',
             '317614X32X721' => '',
             '317614X32X723' => '',
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
             '317614X32X749' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

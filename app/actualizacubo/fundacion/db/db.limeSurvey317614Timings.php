<?php
/**
 * Table Definition for lime_survey_317614_timings
 */

class DataObjects_LimeSurvey317614Timings extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_survey_317614_timings';      // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_interviewtime;                   // real(12)  
    public $_317614X32time;                   // real(12)  
    public $_317614X32X746time;               // real(12)  
    public $_317614X32X747time;               // real(12)  
    public $_317614X32X748time;               // real(12)  
    public $_317614X32X699time;               // real(12)  
    public $_317614X32X700time;               // real(12)  
    public $_317614X32X701time;               // real(12)  
    public $_317614X32X741time;               // real(12)  
    public $_317614X32X702time;               // real(12)  
    public $_317614X32X703time;               // real(12)  
    public $_317614X32X705time;               // real(12)  
    public $_317614X32X706time;               // real(12)  
    public $_317614X32X707time;               // real(12)  
    public $_317614X32X710time;               // real(12)  
    public $_317614X32X711time;               // real(12)  
    public $_317614X32X712time;               // real(12)  
    public $_317614X32X713time;               // real(12)  
    public $_317614X32X704time;               // real(12)  
    public $_317614X32X716time;               // real(12)  
    public $_317614X32X719time;               // real(12)  
    public $_317614X32X720time;               // real(12)  
    public $_317614X32X727time;               // real(12)  
    public $_317614X32X728time;               // real(12)  
    public $_317614X32X733time;               // real(12)  
    public $_317614X32X721time;               // real(12)  
    public $_317614X32X723time;               // real(12)  
    public $_317614X32X714time;               // real(12)  
    public $_317614X32X715time;               // real(12)  
    public $_317614X32X742time;               // real(12)  
    public $_317614X32X734time;               // real(12)  
    public $_317614X32X735time;               // real(12)  
    public $_317614X32X736time;               // real(12)  
    public $_317614X32X737time;               // real(12)  
    public $_317614X32X738time;               // real(12)  
    public $_317614X32X739time;               // real(12)  
    public $_317614X32X740time;               // real(12)  
    public $_317614X32X744time;               // real(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurvey317614Timings',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'interviewtime' =>  DB_DATAOBJECT_INT,
             '317614X32time' =>  DB_DATAOBJECT_INT,
             '317614X32X746time' =>  DB_DATAOBJECT_INT,
             '317614X32X747time' =>  DB_DATAOBJECT_INT,
             '317614X32X748time' =>  DB_DATAOBJECT_INT,
             '317614X32X699time' =>  DB_DATAOBJECT_INT,
             '317614X32X700time' =>  DB_DATAOBJECT_INT,
             '317614X32X701time' =>  DB_DATAOBJECT_INT,
             '317614X32X741time' =>  DB_DATAOBJECT_INT,
             '317614X32X702time' =>  DB_DATAOBJECT_INT,
             '317614X32X703time' =>  DB_DATAOBJECT_INT,
             '317614X32X705time' =>  DB_DATAOBJECT_INT,
             '317614X32X706time' =>  DB_DATAOBJECT_INT,
             '317614X32X707time' =>  DB_DATAOBJECT_INT,
             '317614X32X710time' =>  DB_DATAOBJECT_INT,
             '317614X32X711time' =>  DB_DATAOBJECT_INT,
             '317614X32X712time' =>  DB_DATAOBJECT_INT,
             '317614X32X713time' =>  DB_DATAOBJECT_INT,
             '317614X32X704time' =>  DB_DATAOBJECT_INT,
             '317614X32X716time' =>  DB_DATAOBJECT_INT,
             '317614X32X719time' =>  DB_DATAOBJECT_INT,
             '317614X32X720time' =>  DB_DATAOBJECT_INT,
             '317614X32X727time' =>  DB_DATAOBJECT_INT,
             '317614X32X728time' =>  DB_DATAOBJECT_INT,
             '317614X32X733time' =>  DB_DATAOBJECT_INT,
             '317614X32X721time' =>  DB_DATAOBJECT_INT,
             '317614X32X723time' =>  DB_DATAOBJECT_INT,
             '317614X32X714time' =>  DB_DATAOBJECT_INT,
             '317614X32X715time' =>  DB_DATAOBJECT_INT,
             '317614X32X742time' =>  DB_DATAOBJECT_INT,
             '317614X32X734time' =>  DB_DATAOBJECT_INT,
             '317614X32X735time' =>  DB_DATAOBJECT_INT,
             '317614X32X736time' =>  DB_DATAOBJECT_INT,
             '317614X32X737time' =>  DB_DATAOBJECT_INT,
             '317614X32X738time' =>  DB_DATAOBJECT_INT,
             '317614X32X739time' =>  DB_DATAOBJECT_INT,
             '317614X32X740time' =>  DB_DATAOBJECT_INT,
             '317614X32X744time' =>  DB_DATAOBJECT_INT,
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

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

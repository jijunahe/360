<?php
/**
 * Table Definition for lime_survey_828616_timings
 */

class DataObjects_LimeSurvey828616Timings extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_survey_828616_timings';      // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_interviewtime;                   // real(12)  
    public $_828616X27time;                   // real(12)  
    public $_828616X27X661time;               // real(12)  
    public $_828616X27X663time;               // real(12)  
    public $_828616X27X664time;               // real(12)  
    public $_828616X27X730time;               // real(12)  
    public $_828616X27X731time;               // real(12)  
    public $_828616X27X732time;               // real(12)  
    public $_828616X27X658time;               // real(12)  
    public $_828616X27X666time;               // real(12)  
    public $_828616X27X659time;               // real(12)  
    public $_828616X27X668time;               // real(12)  
    public $_828616X27X743time;               // real(12)  
    public $_828616X28time;                   // real(12)  
    public $_828616X28X669time;               // real(12)  
    public $_828616X28X670time;               // real(12)  
    public $_828616X28X671time;               // real(12)  
    public $_828616X28X672time;               // real(12)  
    public $_828616X29time;                   // real(12)  
    public $_828616X29X673time;               // real(12)  
    public $_828616X29X674time;               // real(12)  
    public $_828616X29X675time;               // real(12)  
    public $_828616X29X676time;               // real(12)  
    public $_828616X29X677time;               // real(12)  
    public $_828616X29X679time;               // real(12)  
    public $_828616X29X678time;               // real(12)  
    public $_828616X29X680time;               // real(12)  
    public $_828616X29X725time;               // real(12)  
    public $_828616X30time;                   // real(12)  
    public $_828616X30X682time;               // real(12)  
    public $_828616X30X683time;               // real(12)  
    public $_828616X30X684time;               // real(12)  
    public $_828616X30X685time;               // real(12)  
    public $_828616X30X686time;               // real(12)  
    public $_828616X30X687time;               // real(12)  
    public $_828616X30X688time;               // real(12)  
    public $_828616X31time;                   // real(12)  
    public $_828616X31X690time;               // real(12)  
    public $_828616X31X691time;               // real(12)  
    public $_828616X31X692time;               // real(12)  
    public $_828616X31X693time;               // real(12)  
    public $_828616X31X694time;               // real(12)  
    public $_828616X31X695time;               // real(12)  
    public $_828616X31X696time;               // real(12)  
    public $_828616X31X745time;               // real(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurvey828616Timings',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'interviewtime' =>  DB_DATAOBJECT_INT,
             '828616X27time' =>  DB_DATAOBJECT_INT,
             '828616X27X661time' =>  DB_DATAOBJECT_INT,
             '828616X27X663time' =>  DB_DATAOBJECT_INT,
             '828616X27X664time' =>  DB_DATAOBJECT_INT,
             '828616X27X730time' =>  DB_DATAOBJECT_INT,
             '828616X27X731time' =>  DB_DATAOBJECT_INT,
             '828616X27X732time' =>  DB_DATAOBJECT_INT,
             '828616X27X658time' =>  DB_DATAOBJECT_INT,
             '828616X27X666time' =>  DB_DATAOBJECT_INT,
             '828616X27X659time' =>  DB_DATAOBJECT_INT,
             '828616X27X668time' =>  DB_DATAOBJECT_INT,
             '828616X27X743time' =>  DB_DATAOBJECT_INT,
             '828616X28time' =>  DB_DATAOBJECT_INT,
             '828616X28X669time' =>  DB_DATAOBJECT_INT,
             '828616X28X670time' =>  DB_DATAOBJECT_INT,
             '828616X28X671time' =>  DB_DATAOBJECT_INT,
             '828616X28X672time' =>  DB_DATAOBJECT_INT,
             '828616X29time' =>  DB_DATAOBJECT_INT,
             '828616X29X673time' =>  DB_DATAOBJECT_INT,
             '828616X29X674time' =>  DB_DATAOBJECT_INT,
             '828616X29X675time' =>  DB_DATAOBJECT_INT,
             '828616X29X676time' =>  DB_DATAOBJECT_INT,
             '828616X29X677time' =>  DB_DATAOBJECT_INT,
             '828616X29X679time' =>  DB_DATAOBJECT_INT,
             '828616X29X678time' =>  DB_DATAOBJECT_INT,
             '828616X29X680time' =>  DB_DATAOBJECT_INT,
             '828616X29X725time' =>  DB_DATAOBJECT_INT,
             '828616X30time' =>  DB_DATAOBJECT_INT,
             '828616X30X682time' =>  DB_DATAOBJECT_INT,
             '828616X30X683time' =>  DB_DATAOBJECT_INT,
             '828616X30X684time' =>  DB_DATAOBJECT_INT,
             '828616X30X685time' =>  DB_DATAOBJECT_INT,
             '828616X30X686time' =>  DB_DATAOBJECT_INT,
             '828616X30X687time' =>  DB_DATAOBJECT_INT,
             '828616X30X688time' =>  DB_DATAOBJECT_INT,
             '828616X31time' =>  DB_DATAOBJECT_INT,
             '828616X31X690time' =>  DB_DATAOBJECT_INT,
             '828616X31X691time' =>  DB_DATAOBJECT_INT,
             '828616X31X692time' =>  DB_DATAOBJECT_INT,
             '828616X31X693time' =>  DB_DATAOBJECT_INT,
             '828616X31X694time' =>  DB_DATAOBJECT_INT,
             '828616X31X695time' =>  DB_DATAOBJECT_INT,
             '828616X31X696time' =>  DB_DATAOBJECT_INT,
             '828616X31X745time' =>  DB_DATAOBJECT_INT,
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

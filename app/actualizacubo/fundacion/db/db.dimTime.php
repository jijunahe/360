<?php
/**
 * Table Definition for dim_time
 */

class DataObjects_DimTime extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'dim_time';                        // table name
    public $_MONTH_ID;                        // int(11)  
    public $_YEAR_ID;                         // int(11)  
    public $_MONTH_NAME;                      // string(15)  
    public $_DATE_ID;                         // int(11)  
    public $_time_key;                        // int(15)  not_null primary_key unsigned
    public $_quarter_number;                  // int(2)  
    public $_quarter_name;                    // string(20)  
    public $_yesterday;                       // string(4)  
    public $_lastweek;                        // string(4)  
    public $_lastmonth;                       // string(4)  
    public $_today;                           // string(4)  
    public $_MONTH_NAME_NUM;                  // blob(255)  blob
    public $_DATE_NAME_NUM;                   // blob(255)  blob
    public $_week_number;                     // int(4)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_DimTime',$k,$v); }

    function table()
    {
         return array(
             'MONTH_ID' =>  DB_DATAOBJECT_INT,
             'YEAR_ID' =>  DB_DATAOBJECT_INT,
             'MONTH_NAME' =>  DB_DATAOBJECT_STR,
             'DATE_ID' =>  DB_DATAOBJECT_INT,
             'time_key' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'quarter_number' =>  DB_DATAOBJECT_INT,
             'quarter_name' =>  DB_DATAOBJECT_STR,
             'yesterday' =>  DB_DATAOBJECT_STR,
             'lastweek' =>  DB_DATAOBJECT_STR,
             'lastmonth' =>  DB_DATAOBJECT_STR,
             'today' =>  DB_DATAOBJECT_STR,
             'MONTH_NAME_NUM' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'DATE_NAME_NUM' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'week_number' =>  DB_DATAOBJECT_INT,
         );
    }

    function keys()
    {
         return array('time_key');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'MONTH_ID' => 1,
             'YEAR_ID' => 1900,
             'MONTH_NAME' => 'enero',
             'DATE_ID' => 1,
             'time_key' => 190011,
             'quarter_number' => 1,
             'quarter_name' => 'Ene-Mar',
             'yesterday' => '0',
             'lastweek' => '0',
             'lastmonth' => '0',
             'today' => '0',
             'MONTH_NAME_NUM' => '',
             'DATE_NAME_NUM' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

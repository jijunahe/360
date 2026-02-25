<?php
/**
 * Table Definition for testdatos
 */

class DataObjects_Testdatos extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'testdatos';                       // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_a;                               // string(100)  
    public $_b;                               // string(100)  
    public $_c;                               // string(100)  
    public $_d;                               // string(100)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Testdatos',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'a' =>  DB_DATAOBJECT_STR,
             'b' =>  DB_DATAOBJECT_STR,
             'c' =>  DB_DATAOBJECT_STR,
             'd' =>  DB_DATAOBJECT_STR,
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
             'a' => '',
             'b' => '',
             'c' => '',
             'd' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

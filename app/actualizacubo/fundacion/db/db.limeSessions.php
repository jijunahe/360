<?php
/**
 * Table Definition for lime_sessions
 */

class DataObjects_LimeSessions extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_sessions';                   // table name
    public $_id;                              // string(32)  not_null primary_key
    public $_expire;                          // int(11)  
    public $_data;                            // blob(4294967295)  blob binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSessions',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'expire' =>  DB_DATAOBJECT_INT,
             'data' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'id' => '',
             'data' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

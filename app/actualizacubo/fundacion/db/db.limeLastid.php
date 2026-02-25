<?php
/**
 * Table Definition for lime_lastid
 */

class DataObjects_LimeLastid extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_lastid';                     // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_total;                           // int(12)  
    public $_sid;                             // int(12)  
    public $_lastID;                          // int(12)  not_null
    public $_fecha;                           // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeLastid',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'total' =>  DB_DATAOBJECT_INT,
             'sid' =>  DB_DATAOBJECT_INT,
             'lastID' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'fecha' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
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

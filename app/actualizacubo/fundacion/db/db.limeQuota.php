<?php
/**
 * Table Definition for lime_quota
 */

class DataObjects_LimeQuota extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_quota';                      // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_sid;                             // int(11)  multiple_key
    public $_name;                            // string(255)  
    public $_qlimit;                          // int(11)  
    public $_action;                          // int(11)  
    public $_active;                          // int(11)  not_null
    public $_autoload_url;                    // int(11)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeQuota',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT,
             'name' =>  DB_DATAOBJECT_STR,
             'qlimit' =>  DB_DATAOBJECT_INT,
             'action' =>  DB_DATAOBJECT_INT,
             'active' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'autoload_url' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
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
             'name' => '',
             'active' => 1,
             'autoload_url' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

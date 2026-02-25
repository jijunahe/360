<?php
/**
 * Table Definition for lime_plugins
 */

class DataObjects_LimePlugins extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_plugins';                    // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_name;                            // string(50)  not_null
    public $_active;                          // int(1)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimePlugins',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'active' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_BOOL + DB_DATAOBJECT_NOTNULL,
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
             'active' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

<?php
/**
 * Table Definition for lime_groups
 */

class DataObjects_LimeGroups extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_groups';                     // table name
    public $_gid;                             // int(11)  not_null primary_key auto_increment
    public $_sid;                             // int(11)  not_null multiple_key
    public $_group_name;                      // string(100)  not_null
    public $_group_order;                     // int(11)  not_null
    public $_description;                     // blob(65535)  blob
    public $_language;                        // string(20)  not_null primary_key
    public $_randomization_group;             // string(20)  not_null
    public $_grelevance;                      // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeGroups',$k,$v); }

    function table()
    {
         return array(
             'gid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'group_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'group_order' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'description' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'randomization_group' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'grelevance' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
         );
    }

    function keys()
    {
         return array('gid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'sid' => 0,
             'group_name' => '',
             'group_order' => 0,
             'description' => '',
             'language' => 'en',
             'randomization_group' => '',
             'grelevance' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

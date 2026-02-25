<?php
/**
 * Table Definition for lime_permissions
 */

class DataObjects_LimePermissions extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_permissions';                // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_entity;                          // string(50)  not_null
    public $_entity_id;                       // int(11)  not_null multiple_key
    public $_uid;                             // int(11)  not_null
    public $_permission;                      // string(100)  not_null
    public $_create_p;                        // int(11)  not_null
    public $_read_p;                          // int(11)  not_null
    public $_update_p;                        // int(11)  not_null
    public $_delete_p;                        // int(11)  not_null
    public $_import_p;                        // int(11)  not_null
    public $_export_p;                        // int(11)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimePermissions',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'entity' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'entity_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'uid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'permission' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'create_p' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'read_p' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'update_p' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'delete_p' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'import_p' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'export_p' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
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
             'entity' => '',
             'permission' => '',
             'create_p' => 0,
             'read_p' => 0,
             'update_p' => 0,
             'delete_p' => 0,
             'import_p' => 0,
             'export_p' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

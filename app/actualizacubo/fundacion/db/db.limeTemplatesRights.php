<?php
/**
 * Table Definition for lime_templates_rights
 */

class DataObjects_LimeTemplatesRights extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_templates_rights';           // table name
    public $_uid;                             // int(11)  not_null primary_key
    public $_folder;                          // string(255)  not_null primary_key
    public $_use;                             // int(11)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeTemplatesRights',$k,$v); }

    function table()
    {
         return array(
             'uid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'folder' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'use' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('uid', 'folder');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'folder' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

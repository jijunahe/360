<?php
/**
 * Table Definition for lime_plugin_settings
 */

class DataObjects_LimePluginSettings extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_plugin_settings';            // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_plugin_id;                       // int(11)  not_null
    public $_model;                           // string(50)  
    public $_model_id;                        // int(11)  
    public $_key;                             // string(50)  not_null
    public $_value;                           // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimePluginSettings',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'plugin_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'model' =>  DB_DATAOBJECT_STR,
             'model_id' =>  DB_DATAOBJECT_INT,
             'key' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'value' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'model' => '',
             'key' => '',
             'value' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

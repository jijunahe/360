<?php
/**
 * Table Definition for lime_settings_global
 */

class DataObjects_LimeSettingsGlobal extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_settings_global';            // table name
    public $_stg_name;                        // string(50)  not_null primary_key
    public $_stg_value;                       // string(255)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSettingsGlobal',$k,$v); }

    function table()
    {
         return array(
             'stg_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'stg_value' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('stg_name');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'stg_name' => '',
             'stg_value' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

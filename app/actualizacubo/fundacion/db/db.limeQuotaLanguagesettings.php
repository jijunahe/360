<?php
/**
 * Table Definition for lime_quota_languagesettings
 */

class DataObjects_LimeQuotaLanguagesettings extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_quota_languagesettings';     // table name
    public $_quotals_id;                      // int(11)  not_null primary_key auto_increment
    public $_quotals_quota_id;                // int(11)  not_null
    public $_quotals_language;                // string(45)  not_null
    public $_quotals_name;                    // string(255)  
    public $_quotals_message;                 // blob(65535)  not_null blob
    public $_quotals_url;                     // string(255)  
    public $_quotals_urldescrip;              // string(255)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeQuotaLanguagesettings',$k,$v); }

    function table()
    {
         return array(
             'quotals_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'quotals_quota_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'quotals_language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'quotals_name' =>  DB_DATAOBJECT_STR,
             'quotals_message' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'quotals_url' =>  DB_DATAOBJECT_STR,
             'quotals_urldescrip' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('quotals_id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'quotals_quota_id' => 0,
             'quotals_language' => 'en',
             'quotals_name' => '',
             'quotals_message' => '',
             'quotals_url' => '',
             'quotals_urldescrip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

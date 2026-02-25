<?php
/**
 * Table Definition for lime_failed_login_attempts
 */

class DataObjects_LimeFailedLoginAttempts extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_failed_login_attempts';      // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_ip;                              // string(40)  not_null
    public $_last_attempt;                    // string(20)  not_null
    public $_number_attempts;                 // int(11)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeFailedLoginAttempts',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'ip' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'last_attempt' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'number_attempts' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
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
             'ip' => '',
             'last_attempt' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

<?php
/**
 * Table Definition for lime_saved_control
 */

class DataObjects_LimeSavedControl extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_saved_control';              // table name
    public $_scid;                            // int(11)  not_null primary_key auto_increment
    public $_sid;                             // int(11)  not_null multiple_key
    public $_srid;                            // int(11)  not_null
    public $_identifier;                      // blob(65535)  not_null blob
    public $_access_code;                     // blob(65535)  not_null blob
    public $_email;                           // string(254)  
    public $_ip;                              // blob(65535)  not_null blob
    public $_saved_thisstep;                  // blob(65535)  not_null blob
    public $_status;                          // string(1)  not_null
    public $_saved_date;                      // datetime(19)  not_null binary
    public $_refurl;                          // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSavedControl',$k,$v); }

    function table()
    {
         return array(
             'scid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'srid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'identifier' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'access_code' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'email' =>  DB_DATAOBJECT_STR,
             'ip' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'saved_thisstep' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'status' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'saved_date' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'refurl' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
         );
    }

    function keys()
    {
         return array('scid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'sid' => 0,
             'srid' => 0,
             'identifier' => '',
             'access_code' => '',
             'email' => '',
             'ip' => '',
             'saved_thisstep' => '',
             'status' => '',
             'refurl' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

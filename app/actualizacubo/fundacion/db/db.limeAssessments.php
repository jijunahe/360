<?php
/**
 * Table Definition for lime_assessments
 */

class DataObjects_LimeAssessments extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_assessments';                // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_sid;                             // int(11)  not_null multiple_key
    public $_scope;                           // string(5)  not_null
    public $_gid;                             // int(11)  not_null multiple_key
    public $_name;                            // blob(65535)  not_null blob
    public $_minimum;                         // string(50)  not_null
    public $_maximum;                         // string(50)  not_null
    public $_message;                         // blob(65535)  not_null blob
    public $_language;                        // string(20)  not_null primary_key

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeAssessments',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'scope' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'gid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'minimum' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'maximum' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'message' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
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
             'sid' => 0,
             'scope' => '',
             'gid' => 0,
             'name' => '',
             'minimum' => '',
             'maximum' => '',
             'message' => '',
             'language' => 'en',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

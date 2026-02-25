<?php
/**
 * Table Definition for lime_defaultvalues
 */

class DataObjects_LimeDefaultvalues extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_defaultvalues';              // table name
    public $_qid;                             // int(11)  not_null primary_key
    public $_scale_id;                        // int(11)  not_null primary_key
    public $_sqid;                            // int(11)  not_null primary_key
    public $_language;                        // string(20)  not_null primary_key
    public $_specialtype;                     // string(20)  not_null primary_key
    public $_defaultvalue;                    // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeDefaultvalues',$k,$v); }

    function table()
    {
         return array(
             'qid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'scale_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sqid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'specialtype' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'defaultvalue' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
         );
    }

    function keys()
    {
         return array('qid', 'scale_id', 'sqid', 'language', 'specialtype');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'qid' => 0,
             'scale_id' => 0,
             'sqid' => 0,
             'language' => '',
             'specialtype' => '',
             'defaultvalue' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

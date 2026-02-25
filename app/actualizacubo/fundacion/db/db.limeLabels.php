<?php
/**
 * Table Definition for lime_labels
 */

class DataObjects_LimeLabels extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_labels';                     // table name
    public $_lid;                             // int(11)  not_null primary_key
    public $_code;                            // string(5)  not_null multiple_key
    public $_title;                           // blob(65535)  blob
    public $_sortorder;                       // int(11)  not_null primary_key
    public $_language;                        // string(20)  not_null primary_key
    public $_assessment_value;                // int(11)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeLabels',$k,$v); }

    function table()
    {
         return array(
             'lid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'code' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'title' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'sortorder' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'assessment_value' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('lid', 'sortorder', 'language');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'lid' => 0,
             'code' => '',
             'title' => '',
             'language' => 'en',
             'assessment_value' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

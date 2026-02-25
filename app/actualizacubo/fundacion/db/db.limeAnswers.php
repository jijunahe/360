<?php
/**
 * Table Definition for lime_answers
 */

class DataObjects_LimeAnswers extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_answers';                    // table name
    public $_qid;                             // int(11)  not_null primary_key
    public $_code;                            // string(5)  not_null primary_key
    public $_answer;                          // blob(65535)  not_null blob
    public $_sortorder;                       // int(11)  not_null multiple_key
    public $_assessment_value;                // int(11)  not_null
    public $_language;                        // string(20)  not_null primary_key
    public $_scale_id;                        // int(11)  not_null primary_key

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeAnswers',$k,$v); }

    function table()
    {
         return array(
             'qid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'code' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'answer' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'sortorder' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'assessment_value' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'scale_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('qid', 'code', 'language', 'scale_id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'qid' => 0,
             'code' => '',
             'answer' => '',
             'assessment_value' => 0,
             'language' => 'en',
             'scale_id' => 0,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

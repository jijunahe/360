<?php
/**
 * Table Definition for lime_question_attributes
 */

class DataObjects_LimeQuestionAttributes extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_question_attributes';        // table name
    public $_qaid;                            // int(11)  not_null primary_key auto_increment
    public $_qid;                             // int(11)  not_null multiple_key
    public $_attribute;                       // string(50)  multiple_key
    public $_value;                           // blob(65535)  blob
    public $_language;                        // string(20)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeQuestionAttributes',$k,$v); }

    function table()
    {
         return array(
             'qaid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'qid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'attribute' =>  DB_DATAOBJECT_STR,
             'value' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'language' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('qaid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'qid' => 0,
             'attribute' => '',
             'value' => '',
             'language' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

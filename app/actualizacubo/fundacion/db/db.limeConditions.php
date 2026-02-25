<?php
/**
 * Table Definition for lime_conditions
 */

class DataObjects_LimeConditions extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_conditions';                 // table name
    public $_cid;                             // int(11)  not_null primary_key auto_increment
    public $_qid;                             // int(11)  not_null multiple_key
    public $_cqid;                            // int(11)  not_null multiple_key
    public $_cfieldname;                      // string(50)  not_null
    public $_method;                          // string(5)  not_null
    public $_value;                           // string(255)  not_null
    public $_scenario;                        // int(11)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeConditions',$k,$v); }

    function table()
    {
         return array(
             'cid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'qid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'cqid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'cfieldname' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'method' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'value' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'scenario' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('cid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'qid' => 0,
             'cqid' => 0,
             'cfieldname' => '',
             'method' => '',
             'value' => '',
             'scenario' => 1,
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

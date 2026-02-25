<?php
/**
 * Table Definition for lime_quota_members
 */

class DataObjects_LimeQuotaMembers extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_quota_members';              // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_sid;                             // int(11)  multiple_key
    public $_qid;                             // int(11)  
    public $_quota_id;                        // int(11)  
    public $_code;                            // string(11)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeQuotaMembers',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT,
             'qid' =>  DB_DATAOBJECT_INT,
             'quota_id' =>  DB_DATAOBJECT_INT,
             'code' =>  DB_DATAOBJECT_STR,
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
             'code' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

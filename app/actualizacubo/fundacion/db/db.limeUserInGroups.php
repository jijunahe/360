<?php
/**
 * Table Definition for lime_user_in_groups
 */

class DataObjects_LimeUserInGroups extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_user_in_groups';             // table name
    public $_ugid;                            // int(11)  not_null primary_key
    public $_uid;                             // int(11)  not_null primary_key

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeUserInGroups',$k,$v); }

    function table()
    {
         return array(
             'ugid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'uid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('ugid', 'uid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

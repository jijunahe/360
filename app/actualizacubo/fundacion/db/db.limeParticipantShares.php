<?php
/**
 * Table Definition for lime_participant_shares
 */

class DataObjects_LimeParticipantShares extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_participant_shares';         // table name
    public $_participant_id;                  // string(50)  not_null primary_key
    public $_share_uid;                       // int(11)  not_null primary_key
    public $_date_added;                      // datetime(19)  not_null binary
    public $_can_edit;                        // string(5)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeParticipantShares',$k,$v); }

    function table()
    {
         return array(
             'participant_id' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'share_uid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'date_added' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'can_edit' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('participant_id', 'share_uid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'participant_id' => '',
             'can_edit' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

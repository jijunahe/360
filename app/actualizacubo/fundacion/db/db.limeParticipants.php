<?php
/**
 * Table Definition for lime_participants
 */

class DataObjects_LimeParticipants extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_participants';               // table name
    public $_participant_id;                  // string(50)  not_null primary_key
    public $_firstname;                       // string(40)  
    public $_lastname;                        // string(40)  
    public $_email;                           // string(254)  
    public $_language;                        // string(40)  
    public $_blacklisted;                     // string(1)  not_null
    public $_owner_uid;                       // int(11)  not_null
    public $_created_by;                      // int(11)  not_null
    public $_created;                         // datetime(19)  binary
    public $_modified;                        // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeParticipants',$k,$v); }

    function table()
    {
         return array(
             'participant_id' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'firstname' =>  DB_DATAOBJECT_STR,
             'lastname' =>  DB_DATAOBJECT_STR,
             'email' =>  DB_DATAOBJECT_STR,
             'language' =>  DB_DATAOBJECT_STR,
             'blacklisted' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'owner_uid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'created_by' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'created' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'modified' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
         );
    }

    function keys()
    {
         return array('participant_id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'participant_id' => '',
             'firstname' => '',
             'lastname' => '',
             'email' => '',
             'language' => '',
             'blacklisted' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

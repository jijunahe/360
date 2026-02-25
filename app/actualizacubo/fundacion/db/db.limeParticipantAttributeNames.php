<?php
/**
 * Table Definition for lime_participant_attribute_names
 */

class DataObjects_LimeParticipantAttributeNames extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_participant_attribute_names';    // table name
    public $_attribute_id;                    // int(11)  not_null primary_key auto_increment
    public $_attribute_type;                  // string(4)  not_null
    public $_defaultname;                     // string(50)  not_null
    public $_visible;                         // string(5)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeParticipantAttributeNames',$k,$v); }

    function table()
    {
         return array(
             'attribute_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'attribute_type' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'defaultname' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'visible' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('attribute_id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'attribute_type' => '',
             'defaultname' => '',
             'visible' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

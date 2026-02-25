<?php
/**
 * Table Definition for lime_participant_attribute_values
 */

class DataObjects_LimeParticipantAttributeValues extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_participant_attribute_values';    // table name
    public $_value_id;                        // int(11)  not_null primary_key auto_increment
    public $_attribute_id;                    // int(11)  not_null
    public $_value;                           // blob(65535)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeParticipantAttributeValues',$k,$v); }

    function table()
    {
         return array(
             'value_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'attribute_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'value' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('value_id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'value' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

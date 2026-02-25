<?php
/**
 * Table Definition for lime_participant_attribute_names_lang
 */

class DataObjects_LimeParticipantAttributeNamesLang extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_participant_attribute_names_lang';    // table name
    public $_attribute_id;                    // int(11)  not_null primary_key
    public $_attribute_name;                  // string(30)  not_null
    public $_lang;                            // string(255)  not_null primary_key

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeParticipantAttributeNamesLang',$k,$v); }

    function table()
    {
         return array(
             'attribute_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'attribute_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'lang' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('attribute_id', 'lang');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'attribute_name' => '',
             'lang' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

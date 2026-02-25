<?php
/**
 * Table Definition for lime_labelsets
 */

class DataObjects_LimeLabelsets extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_labelsets';                  // table name
    public $_lid;                             // int(11)  not_null primary_key auto_increment
    public $_label_name;                      // string(100)  not_null
    public $_languages;                       // string(200)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeLabelsets',$k,$v); }

    function table()
    {
         return array(
             'lid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'label_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'languages' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('lid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'label_name' => '',
             'languages' => 'en',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

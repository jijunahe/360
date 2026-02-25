<?php
/**
 * Table Definition for view_totalregistrados
 */

class DataObjects_ViewTotalregistrados extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'view_totalregistrados';           // table name
    public $_total;                           // int(21)  not_null
    public $_estado;                          // string(36)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_ViewTotalregistrados',$k,$v); }

    function table()
    {
         return array(
             'total' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'estado' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array();
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'total' => 0,
             'estado' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

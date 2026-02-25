<?php
/**
 * Table Definition for lime_view_participantes_dobles
 */

class DataObjects_LimeViewParticipantesDobles extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_view_participantes_dobles';    // table name
    public $_id;                              // int(11)  not_null
    public $_431454X14X248;                   // real(32)  
    public $_TOTAL;                           // int(21)  not_null
    public $_431454X14X247;                   // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeViewParticipantesDobles',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             '431454X14X248' =>  DB_DATAOBJECT_INT,
             'TOTAL' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             '431454X14X247' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'id' => 0,
             'TOTAL' => 0,
             '431454X14X247' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

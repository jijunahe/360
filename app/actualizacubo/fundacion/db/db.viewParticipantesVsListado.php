<?php
/**
 * Table Definition for view_participantes_vs_listado
 */

class DataObjects_ViewParticipantesVsListado extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'view_participantes_vs_listado';    // table name
    public $_nombreresgistrado;               // string(150)  
    public $_documentoresgistrado;            // string(150)  
    public $_documentobase;                   // string(90)  
    public $_nombrebase;                      // string(600)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_ViewParticipantesVsListado',$k,$v); }

    function table()
    {
         return array(
             'nombreresgistrado' =>  DB_DATAOBJECT_STR,
             'documentoresgistrado' =>  DB_DATAOBJECT_STR,
             'documentobase' =>  DB_DATAOBJECT_STR,
             'nombrebase' =>  DB_DATAOBJECT_STR,
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
             'nombreresgistrado' => '',
             'documentoresgistrado' => '',
             'documentobase' => '',
             'nombrebase' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

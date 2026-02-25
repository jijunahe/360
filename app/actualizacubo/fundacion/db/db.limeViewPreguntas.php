<?php
/**
 * Table Definition for lime_view_preguntas
 */

class DataObjects_LimeViewPreguntas extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_view_preguntas';             // table name
    public $_qid;                             // int(11)  not_null
    public $_parent_qid;                      // int(11)  not_null
    public $_sid;                             // int(11)  not_null
    public $_gid;                             // int(11)  not_null
    public $_codigopregunta;                  // string(165)  not_null
    public $_type;                            // string(3)  not_null
    public $_title;                           // string(60)  not_null
    public $_question;                        // string(12000)  
    public $_preg;                            // blob(65535)  blob
    public $_help;                            // blob(65535)  blob
    public $_other;                           // string(3)  not_null
    public $_mandatory;                       // string(3)  
    public $_question_order;                  // int(11)  not_null
    public $_language;                        // string(60)  not_null
    public $_scale_id;                        // int(11)  not_null
    public $_same_default;                    // int(11)  not_null
    public $_relevance;                       // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeViewPreguntas',$k,$v); }

    function table()
    {
         return array(
             'qid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'parent_qid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'gid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'codigopregunta' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'type' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'title' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'question' =>  DB_DATAOBJECT_STR,
             'preg' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'help' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'other' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'mandatory' =>  DB_DATAOBJECT_STR,
             'question_order' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'scale_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'same_default' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'relevance' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'qid' => 0,
             'parent_qid' => 0,
             'sid' => 0,
             'gid' => 0,
             'codigopregunta' => '',
             'type' => 'T',
             'title' => '',
             'question' => '',
             'preg' => '',
             'help' => '',
             'other' => 'N',
             'mandatory' => '',
             'language' => 'en',
             'scale_id' => 0,
             'same_default' => 0,
             'relevance' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

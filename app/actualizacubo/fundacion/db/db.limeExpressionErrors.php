<?php
/**
 * Table Definition for lime_expression_errors
 */

class DataObjects_LimeExpressionErrors extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_expression_errors';          // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_errortime;                       // string(50)  
    public $_sid;                             // int(11)  
    public $_gid;                             // int(11)  
    public $_qid;                             // int(11)  
    public $_gseq;                            // int(11)  
    public $_qseq;                            // int(11)  
    public $_type;                            // string(50)  
    public $_eqn;                             // blob(65535)  blob
    public $_prettyprint;                     // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeExpressionErrors',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'errortime' =>  DB_DATAOBJECT_STR,
             'sid' =>  DB_DATAOBJECT_INT,
             'gid' =>  DB_DATAOBJECT_INT,
             'qid' =>  DB_DATAOBJECT_INT,
             'gseq' =>  DB_DATAOBJECT_INT,
             'qseq' =>  DB_DATAOBJECT_INT,
             'type' =>  DB_DATAOBJECT_STR,
             'eqn' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'prettyprint' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'errortime' => '',
             'type' => '',
             'eqn' => '',
             'prettyprint' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

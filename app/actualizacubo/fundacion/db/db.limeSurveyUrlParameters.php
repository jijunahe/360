<?php
/**
 * Table Definition for lime_survey_url_parameters
 */

class DataObjects_LimeSurveyUrlParameters extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_survey_url_parameters';      // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_sid;                             // int(11)  not_null
    public $_parameter;                       // string(50)  not_null
    public $_targetqid;                       // int(11)  
    public $_targetsqid;                      // int(11)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurveyUrlParameters',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'sid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'parameter' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'targetqid' =>  DB_DATAOBJECT_INT,
             'targetsqid' =>  DB_DATAOBJECT_INT,
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
             'parameter' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

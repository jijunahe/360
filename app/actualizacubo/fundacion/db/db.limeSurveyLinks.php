<?php
/**
 * Table Definition for lime_survey_links
 */

class DataObjects_LimeSurveyLinks extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_survey_links';               // table name
    public $_participant_id;                  // string(50)  not_null primary_key
    public $_token_id;                        // int(11)  not_null primary_key
    public $_survey_id;                       // int(11)  not_null primary_key
    public $_date_created;                    // datetime(19)  binary
    public $_date_invited;                    // datetime(19)  binary
    public $_date_completed;                  // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurveyLinks',$k,$v); }

    function table()
    {
         return array(
             'participant_id' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'token_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'survey_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'date_created' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'date_invited' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'date_completed' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
         );
    }

    function keys()
    {
         return array('participant_id', 'token_id', 'survey_id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'participant_id' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

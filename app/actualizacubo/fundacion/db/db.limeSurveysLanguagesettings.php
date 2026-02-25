<?php
/**
 * Table Definition for lime_surveys_languagesettings
 */

class DataObjects_LimeSurveysLanguagesettings extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_surveys_languagesettings';    // table name
    public $_surveyls_survey_id;              // int(11)  not_null primary_key
    public $_surveyls_language;               // string(45)  not_null primary_key
    public $_surveyls_title;                  // string(200)  not_null
    public $_surveyls_description;            // blob(65535)  blob
    public $_surveyls_welcometext;            // blob(65535)  blob
    public $_surveyls_endtext;                // blob(65535)  blob
    public $_surveyls_url;                    // blob(65535)  blob
    public $_surveyls_urldescription;         // string(255)  
    public $_surveyls_email_invite_subj;      // string(255)  
    public $_surveyls_email_invite;           // blob(65535)  blob
    public $_surveyls_email_remind_subj;      // string(255)  
    public $_surveyls_email_remind;           // blob(65535)  blob
    public $_surveyls_email_register_subj;    // string(255)  
    public $_surveyls_email_register;         // blob(65535)  blob
    public $_surveyls_email_confirm_subj;     // string(255)  
    public $_surveyls_email_confirm;          // blob(65535)  blob
    public $_surveyls_dateformat;             // int(11)  not_null
    public $_surveyls_attributecaptions;      // blob(65535)  blob
    public $_email_admin_notification_subj;    // string(255)  
    public $_email_admin_notification;        // blob(65535)  blob
    public $_email_admin_responses_subj;      // string(255)  
    public $_email_admin_responses;           // blob(65535)  blob
    public $_surveyls_numberformat;           // int(11)  not_null
    public $_attachments;                     // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurveysLanguagesettings',$k,$v); }

    function table()
    {
         return array(
             'surveyls_survey_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'surveyls_language' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'surveyls_title' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'surveyls_description' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_welcometext' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_endtext' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_url' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_urldescription' =>  DB_DATAOBJECT_STR,
             'surveyls_email_invite_subj' =>  DB_DATAOBJECT_STR,
             'surveyls_email_invite' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_email_remind_subj' =>  DB_DATAOBJECT_STR,
             'surveyls_email_remind' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_email_register_subj' =>  DB_DATAOBJECT_STR,
             'surveyls_email_register' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_email_confirm_subj' =>  DB_DATAOBJECT_STR,
             'surveyls_email_confirm' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_dateformat' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'surveyls_attributecaptions' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'email_admin_notification_subj' =>  DB_DATAOBJECT_STR,
             'email_admin_notification' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'email_admin_responses_subj' =>  DB_DATAOBJECT_STR,
             'email_admin_responses' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'surveyls_numberformat' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'attachments' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
         );
    }

    function keys()
    {
         return array('surveyls_survey_id', 'surveyls_language');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'surveyls_language' => 'en',
             'surveyls_title' => '',
             'surveyls_description' => '',
             'surveyls_welcometext' => '',
             'surveyls_endtext' => '',
             'surveyls_url' => '',
             'surveyls_urldescription' => '',
             'surveyls_email_invite_subj' => '',
             'surveyls_email_invite' => '',
             'surveyls_email_remind_subj' => '',
             'surveyls_email_remind' => '',
             'surveyls_email_register_subj' => '',
             'surveyls_email_register' => '',
             'surveyls_email_confirm_subj' => '',
             'surveyls_email_confirm' => '',
             'surveyls_dateformat' => 1,
             'surveyls_attributecaptions' => '',
             'email_admin_notification_subj' => '',
             'email_admin_notification' => '',
             'email_admin_responses_subj' => '',
             'email_admin_responses' => '',
             'surveyls_numberformat' => 0,
             'attachments' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

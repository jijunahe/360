<?php
/**
 * Table Definition for lime_users
 */

class DataObjects_LimeUsers extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_users';                      // table name
    public $_uid;                             // int(11)  not_null primary_key auto_increment
    public $_users_name;                      // string(64)  not_null unique_key
    public $_password;                        // blob(65535)  not_null blob binary
    public $_full_name;                       // string(50)  not_null
    public $_parent_id;                       // int(11)  not_null
    public $_lang;                            // string(20)  
    public $_email;                           // string(254)  
    public $_htmleditormode;                  // string(7)  
    public $_templateeditormode;              // string(7)  not_null
    public $_questionselectormode;            // string(7)  not_null
    public $_one_time_pw;                     // blob(65535)  blob binary
    public $_dateformat;                      // int(11)  not_null
    public $_created;                         // datetime(19)  binary
    public $_modified;                        // datetime(19)  binary
    public $_create_survey;                   // string(255)  
    public $_configurator;                    // string(255)  
    public $_create_user;                     // string(255)  
    public $_delete_user;                     // string(255)  
    public $_superadmin;                      // string(255)  
    public $_manage_template;                 // string(255)  
    public $_manage_label;                    // string(255)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeUsers',$k,$v); }

    function table()
    {
         return array(
             'uid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'users_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'password' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB + DB_DATAOBJECT_NOTNULL,
             'full_name' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'parent_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'lang' =>  DB_DATAOBJECT_STR,
             'email' =>  DB_DATAOBJECT_STR,
             'htmleditormode' =>  DB_DATAOBJECT_STR,
             'templateeditormode' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'questionselectormode' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'one_time_pw' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'dateformat' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'created' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'modified' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'create_survey' =>  DB_DATAOBJECT_STR,
             'configurator' =>  DB_DATAOBJECT_STR,
             'create_user' =>  DB_DATAOBJECT_STR,
             'delete_user' =>  DB_DATAOBJECT_STR,
             'superadmin' =>  DB_DATAOBJECT_STR,
             'manage_template' =>  DB_DATAOBJECT_STR,
             'manage_label' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('uid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'users_name' => '',
             'password' => '',
             'full_name' => '',
             'lang' => '',
             'email' => '',
             'htmleditormode' => 'default',
             'templateeditormode' => 'default',
             'questionselectormode' => 'default',
             'one_time_pw' => '',
             'dateformat' => 1,
             'create_survey' => '',
             'configurator' => '',
             'create_user' => '',
             'delete_user' => '',
             'superadmin' => '',
             'manage_template' => '',
             'manage_label' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

<?php
/**
 * Table Definition for lime_surveys
 */

class DataObjects_LimeSurveys extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_surveys';                    // table name
    public $_sid;                             // int(11)  not_null primary_key
    public $_owner_id;                        // int(11)  not_null
    public $_admin;                           // string(50)  
    public $_active;                          // string(1)  not_null
    public $_expires;                         // datetime(19)  binary
    public $_startdate;                       // datetime(19)  binary
    public $_adminemail;                      // string(254)  
    public $_anonymized;                      // string(1)  not_null
    public $_faxto;                           // string(20)  
    public $_format;                          // string(1)  
    public $_savetimings;                     // string(1)  not_null
    public $_template;                        // string(100)  
    public $_language;                        // string(50)  
    public $_additional_languages;            // string(255)  
    public $_datestamp;                       // string(1)  not_null
    public $_usecookie;                       // string(1)  not_null
    public $_allowregister;                   // string(1)  not_null
    public $_allowsave;                       // string(1)  not_null
    public $_autonumber_start;                // int(11)  not_null
    public $_autoredirect;                    // string(1)  not_null
    public $_allowprev;                       // string(1)  not_null
    public $_printanswers;                    // string(1)  not_null
    public $_ipaddr;                          // string(1)  not_null
    public $_refurl;                          // string(1)  not_null
    public $_datecreated;                     // date(10)  binary
    public $_publicstatistics;                // string(1)  not_null
    public $_publicgraphs;                    // string(1)  not_null
    public $_listpublic;                      // string(1)  not_null
    public $_htmlemail;                       // string(1)  not_null
    public $_sendconfirmation;                // string(1)  not_null
    public $_tokenanswerspersistence;         // string(1)  not_null
    public $_assessments;                     // string(1)  not_null
    public $_usecaptcha;                      // string(1)  not_null
    public $_usetokens;                       // string(1)  not_null
    public $_bounce_email;                    // string(254)  
    public $_attributedescriptions;           // blob(65535)  blob
    public $_emailresponseto;                 // blob(65535)  blob
    public $_emailnotificationto;             // blob(65535)  blob
    public $_tokenlength;                     // int(11)  not_null
    public $_showxquestions;                  // string(1)  
    public $_showgroupinfo;                   // string(1)  
    public $_shownoanswer;                    // string(1)  
    public $_showqnumcode;                    // string(1)  
    public $_bouncetime;                      // int(11)  
    public $_bounceprocessing;                // string(1)  
    public $_bounceaccounttype;               // string(4)  
    public $_bounceaccounthost;               // string(200)  
    public $_bounceaccountpass;               // string(100)  
    public $_bounceaccountencryption;         // string(3)  
    public $_bounceaccountuser;               // string(200)  
    public $_showwelcome;                     // string(1)  
    public $_showprogress;                    // string(1)  
    public $_questionindex;                   // int(11)  not_null
    public $_navigationdelay;                 // int(11)  not_null
    public $_nokeyboard;                      // string(1)  
    public $_alloweditaftercompletion;        // string(1)  
    public $_googleanalyticsstyle;            // string(1)  
    public $_googleanalyticsapikey;           // string(25)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurveys',$k,$v); }

    function table()
    {
         return array(
             'sid' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'owner_id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'admin' =>  DB_DATAOBJECT_STR,
             'active' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'expires' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'startdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'adminemail' =>  DB_DATAOBJECT_STR,
             'anonymized' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'faxto' =>  DB_DATAOBJECT_STR,
             'format' =>  DB_DATAOBJECT_STR,
             'savetimings' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'template' =>  DB_DATAOBJECT_STR,
             'language' =>  DB_DATAOBJECT_STR,
             'additional_languages' =>  DB_DATAOBJECT_STR,
             'datestamp' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'usecookie' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'allowregister' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'allowsave' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'autonumber_start' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'autoredirect' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'allowprev' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'printanswers' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'ipaddr' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'refurl' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'datecreated' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE,
             'publicstatistics' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'publicgraphs' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'listpublic' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'htmlemail' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'sendconfirmation' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'tokenanswerspersistence' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'assessments' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'usecaptcha' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'usetokens' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'bounce_email' =>  DB_DATAOBJECT_STR,
             'attributedescriptions' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'emailresponseto' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'emailnotificationto' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'tokenlength' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'showxquestions' =>  DB_DATAOBJECT_STR,
             'showgroupinfo' =>  DB_DATAOBJECT_STR,
             'shownoanswer' =>  DB_DATAOBJECT_STR,
             'showqnumcode' =>  DB_DATAOBJECT_STR,
             'bouncetime' =>  DB_DATAOBJECT_INT,
             'bounceprocessing' =>  DB_DATAOBJECT_STR,
             'bounceaccounttype' =>  DB_DATAOBJECT_STR,
             'bounceaccounthost' =>  DB_DATAOBJECT_STR,
             'bounceaccountpass' =>  DB_DATAOBJECT_STR,
             'bounceaccountencryption' =>  DB_DATAOBJECT_STR,
             'bounceaccountuser' =>  DB_DATAOBJECT_STR,
             'showwelcome' =>  DB_DATAOBJECT_STR,
             'showprogress' =>  DB_DATAOBJECT_STR,
             'questionindex' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'navigationdelay' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'nokeyboard' =>  DB_DATAOBJECT_STR,
             'alloweditaftercompletion' =>  DB_DATAOBJECT_STR,
             'googleanalyticsstyle' =>  DB_DATAOBJECT_STR,
             'googleanalyticsapikey' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('sid');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('time_key', false, false);
    }

    function defaults() // column default values 
    {
         return array(
             'admin' => '',
             'active' => 'N',
             'adminemail' => '',
             'anonymized' => 'N',
             'faxto' => '',
             'format' => '',
             'savetimings' => 'N',
             'template' => 'default',
             'language' => '',
             'additional_languages' => '',
             'datestamp' => 'N',
             'usecookie' => 'N',
             'allowregister' => 'N',
             'allowsave' => 'Y',
             'autonumber_start' => 0,
             'autoredirect' => 'N',
             'allowprev' => 'N',
             'printanswers' => 'N',
             'ipaddr' => 'N',
             'refurl' => 'N',
             'publicstatistics' => 'N',
             'publicgraphs' => 'N',
             'listpublic' => 'N',
             'htmlemail' => 'N',
             'sendconfirmation' => 'Y',
             'tokenanswerspersistence' => 'N',
             'assessments' => 'N',
             'usecaptcha' => 'N',
             'usetokens' => 'N',
             'bounce_email' => '',
             'attributedescriptions' => '',
             'emailresponseto' => '',
             'emailnotificationto' => '',
             'tokenlength' => 15,
             'showxquestions' => 'Y',
             'showgroupinfo' => 'B',
             'shownoanswer' => 'Y',
             'showqnumcode' => 'X',
             'bounceprocessing' => 'N',
             'bounceaccounttype' => '',
             'bounceaccounthost' => '',
             'bounceaccountpass' => '',
             'bounceaccountencryption' => '',
             'bounceaccountuser' => '',
             'showwelcome' => 'Y',
             'showprogress' => 'Y',
             'questionindex' => 0,
             'navigationdelay' => 0,
             'nokeyboard' => 'N',
             'alloweditaftercompletion' => 'N',
             'googleanalyticsstyle' => '',
             'googleanalyticsapikey' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

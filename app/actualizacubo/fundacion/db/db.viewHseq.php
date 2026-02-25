<?php
/**
 * Table Definition for view_hseq
 */

class DataObjects_ViewHseq extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'view_hseq';                       // table name
    public $_id;                              // int(12)  not_null
    public $_valorEscalaid;                   // int(12)  
    public $_token;                           // string(150)  
    public $_valorEscalatoken;                // int(12)  
    public $_submitdate;                      // datetime(19)  binary
    public $_hora;                            // string(2)  
    public $_submitdateYMD;                   // string(8)  
    public $_ecografia;                       // string(8)  
    public $_mamografia;                      // string(8)  
    public $_citologia;                       // string(8)  
    public $_valorEscalasubmitdate;           // int(12)  
    public $_lastpage;                        // string(150)  
    public $_valorEscalalastpage;             // int(12)  
    public $_startlanguage;                   // string(150)  
    public $_valorEscalastartlanguage;        // int(12)  
    public $_startdate;                       // string(150)  
    public $_valorEscalastartdate;            // int(12)  
    public $_datestamp;                       // string(150)  
    public $_valorEscaladatestamp;            // int(12)  
    public $_ipaddr;                          // string(150)  
    public $_valorEscalaipaddr;               // int(12)  
    public $_refurl;                          // string(150)  
    public $_valorEscalarefurl;               // int(12)  
    public $_431454X14X612;                   // string(150)  
    public $_valorEscala431454X14X612;        // int(12)  
    public $_431454X14X247;                   // string(150)  
    public $_valorEscala431454X14X247;        // int(12)  
    public $_431454X14X250;                   // string(150)  
    public $_valorEscala431454X14X250;        // int(12)  
    public $_431454X14X248;                   // string(150)  
    public $_valorEscala431454X14X248;        // int(12)  
    public $_431454X14X249;                   // string(150)  
    public $_valorEscala431454X14X249;        // int(12)  
    public $_431454X14X638;                   // string(150)  
    public $_valorEscala431454X14X638;        // int(12)  
    public $_431454X14X614;                   // string(150)  
    public $_valorEscala431454X14X614;        // int(12)  
    public $_431454X14X613;                   // string(150)  
    public $_valorEscala431454X14X613;        // int(12)  
    public $_431454X14X251;                   // string(150)  
    public $_valorEscala431454X14X251;        // int(12)  
    public $_431454X14X636;                   // int(12)  
    public $_valorEscala431454X14X636;        // int(12)  
    public $_431454X15X410SQ001;              // string(150)  
    public $_valorEscala431454X15X410SQ001;    // int(12)  
    public $_431454X15X410SQ002;              // string(150)  
    public $_valorEscala431454X15X410SQ002;    // int(12)  
    public $_431454X15X410SQ003;              // string(150)  
    public $_valorEscala431454X15X410SQ003;    // int(12)  
    public $_431454X15X410SQ004;              // string(150)  
    public $_valorEscala431454X15X410SQ004;    // int(12)  
    public $_431454X15X410SQ005;              // string(150)  
    public $_valorEscala431454X15X410SQ005;    // int(12)  
    public $_431454X15X410SQ006;              // string(150)  
    public $_valorEscala431454X15X410SQ006;    // int(12)  
    public $_431454X15X410SQ007;              // string(150)  
    public $_valorEscala431454X15X410SQ007;    // int(12)  
    public $_431454X15X410SQ008;              // string(150)  
    public $_valorEscala431454X15X410SQ008;    // int(12)  
    public $_431454X15X410SQ009;              // string(150)  
    public $_valorEscala431454X15X410SQ009;    // int(12)  
    public $_431454X15X410SQ010;              // string(150)  
    public $_valorEscala431454X15X410SQ010;    // int(12)  
    public $_431454X15X420;                   // string(150)  
    public $_valorEscala431454X15X420;        // int(12)  
    public $_431454X15X421;                   // string(150)  
    public $_valorEscala431454X15X421;        // int(12)  
    public $_431454X15X569;                   // string(150)  
    public $_valorEscala431454X15X569;        // int(12)  
    public $_431454X15X570;                   // string(150)  
    public $_valorEscala431454X15X570;        // int(12)  
    public $_431454X15X571;                   // string(150)  
    public $_valorEscala431454X15X571;        // int(12)  
    public $_431454X15X572;                   // string(150)  
    public $_valorEscala431454X15X572;        // int(12)  
    public $_431454X15X573;                   // string(150)  
    public $_valorEscala431454X15X573;        // int(12)  
    public $_431454X15X574;                   // string(150)  
    public $_valorEscala431454X15X574;        // int(12)  
    public $_431454X15X422SQ001;              // string(150)  
    public $_valorEscala431454X15X422SQ001;    // int(12)  
    public $_431454X15X422SQ002;              // string(150)  
    public $_valorEscala431454X15X422SQ002;    // int(12)  
    public $_431454X15X422SQ003;              // string(150)  
    public $_valorEscala431454X15X422SQ003;    // int(12)  
    public $_431454X15X422SQ004;              // string(150)  
    public $_valorEscala431454X15X422SQ004;    // int(12)  
    public $_431454X15X422SQ005;              // string(150)  
    public $_valorEscala431454X15X422SQ005;    // int(12)  
    public $_431454X15X422SQ006;              // string(150)  
    public $_valorEscala431454X15X422SQ006;    // int(12)  
    public $_431454X15X422SQ007;              // string(150)  
    public $_valorEscala431454X15X422SQ007;    // int(12)  
    public $_431454X15X422SQ008;              // string(150)  
    public $_valorEscala431454X15X422SQ008;    // int(12)  
    public $_431454X15X422SQ009;              // string(150)  
    public $_valorEscala431454X15X422SQ009;    // int(12)  
    public $_431454X15X422SQ010;              // string(150)  
    public $_valorEscala431454X15X422SQ010;    // int(12)  
    public $_431454X15X422SQ011;              // string(150)  
    public $_valorEscala431454X15X422SQ011;    // int(12)  
    public $_431454X15X422SQ012;              // string(150)  
    public $_valorEscala431454X15X422SQ012;    // int(12)  
    public $_431454X15X422SQ013;              // string(150)  
    public $_valorEscala431454X15X422SQ013;    // int(12)  
    public $_431454X15X422SQ014;              // string(150)  
    public $_valorEscala431454X15X422SQ014;    // int(12)  
    public $_431454X15X437SQ001;              // string(150)  
    public $_valorEscala431454X15X437SQ001;    // int(12)  
    public $_431454X15X437SQ002;              // string(150)  
    public $_valorEscala431454X15X437SQ002;    // int(12)  
    public $_431454X15X437SQ003;              // string(150)  
    public $_valorEscala431454X15X437SQ003;    // int(12)  
    public $_431454X15X437SQ004;              // string(150)  
    public $_valorEscala431454X15X437SQ004;    // int(12)  
    public $_431454X15X437SQ005;              // string(150)  
    public $_valorEscala431454X15X437SQ005;    // int(12)  
    public $_431454X15X437SQ006;              // string(150)  
    public $_valorEscala431454X15X437SQ006;    // int(12)  
    public $_431454X15X437SQ007;              // string(150)  
    public $_valorEscala431454X15X437SQ007;    // int(12)  
    public $_431454X15X437SQ008;              // string(150)  
    public $_valorEscala431454X15X437SQ008;    // int(12)  
    public $_431454X15X437SQ009;              // string(150)  
    public $_valorEscala431454X15X437SQ009;    // int(12)  
    public $_431454X15X437SQ010;              // string(150)  
    public $_valorEscala431454X15X437SQ010;    // int(12)  
    public $_431454X15X437SQ011;              // string(150)  
    public $_valorEscala431454X15X437SQ011;    // int(12)  
    public $_431454X15X437SQ012;              // string(150)  
    public $_valorEscala431454X15X437SQ012;    // int(12)  
    public $_431454X15X437SQ013;              // string(150)  
    public $_valorEscala431454X15X437SQ013;    // int(12)  
    public $_431454X15X437SQ014;              // string(150)  
    public $_valorEscala431454X15X437SQ014;    // int(12)  
    public $_431454X15X437SQ015;              // string(150)  
    public $_valorEscala431454X15X437SQ015;    // int(12)  
    public $_431454X15X437SQ016;              // string(150)  
    public $_valorEscala431454X15X437SQ016;    // int(12)  
    public $_431454X15X437SQ017;              // string(150)  
    public $_valorEscala431454X15X437SQ017;    // int(12)  
    public $_431454X15X437SQ018;              // string(150)  
    public $_valorEscala431454X15X437SQ018;    // int(12)  
    public $_431454X15X455;                   // string(150)  
    public $_valorEscala431454X15X455;        // int(12)  
    public $_431454X15X456;                   // string(150)  
    public $_valorEscala431454X15X456;        // int(12)  
    public $_431454X15X457;                   // string(150)  
    public $_valorEscala431454X15X457;        // int(12)  
    public $_431454X15X458;                   // string(150)  
    public $_valorEscala431454X15X458;        // int(12)  
    public $_431454X15X459;                   // string(150)  
    public $_valorEscala431454X15X459;        // int(12)  
    public $_431454X15X460;                   // string(150)  
    public $_valorEscala431454X15X460;        // int(12)  
    public $_431454X15X461;                   // string(150)  
    public $_valorEscala431454X15X461;        // int(12)  
    public $_431454X15X462;                   // string(150)  
    public $_valorEscala431454X15X462;        // int(12)  
    public $_431454X18X351;                   // string(150)  
    public $_valorEscala431454X18X351;        // int(12)  
    public $_431454X18X639;                   // string(150)  
    public $_valorEscala431454X18X639;        // int(12)  
    public $_431454X18X576;                   // string(150)  
    public $_valorEscala431454X18X576;        // int(12)  
    public $_431454X18X577;                   // string(150)  
    public $_valorEscala431454X18X577;        // int(12)  
    public $_431454X18X578;                   // string(150)  
    public $_valorEscala431454X18X578;        // int(12)  
    public $_431454X18X583;                   // string(150)  
    public $_valorEscala431454X18X583;        // int(12)  
    public $_431454X18X640;                   // string(150)  
    public $_valorEscala431454X18X640;        // int(12)  
    public $_431454X18X584;                   // string(150)  
    public $_valorEscala431454X18X584;        // int(12)  
    public $_431454X18X585;                   // string(150)  
    public $_valorEscala431454X18X585;        // int(12)  
    public $_431454X18X586;                   // string(150)  
    public $_valorEscala431454X18X586;        // int(12)  
    public $_431454X18X587;                   // string(150)  
    public $_valorEscala431454X18X587;        // int(12)  
    public $_431454X18X588;                   // string(150)  
    public $_valorEscala431454X18X588;        // int(12)  
    public $_431454X18X589;                   // string(150)  
    public $_valorEscala431454X18X589;        // int(12)  
    public $_431454X18X590;                   // string(150)  
    public $_valorEscala431454X18X590;        // int(12)  
    public $_431454X18X591;                   // string(150)  
    public $_valorEscala431454X18X591;        // int(12)  
    public $_431454X18X592;                   // string(150)  
    public $_valorEscala431454X18X592;        // int(12)  
    public $_431454X18X593;                   // string(150)  
    public $_valorEscala431454X18X593;        // int(12)  
    public $_431454X18X594;                   // string(150)  
    public $_valorEscala431454X18X594;        // int(12)  
    public $_431454X18X595;                   // string(150)  
    public $_valorEscala431454X18X595;        // int(12)  
    public $_431454X18X596;                   // string(150)  
    public $_valorEscala431454X18X596;        // int(12)  
    public $_431454X18X642;                   // string(150)  
    public $_valorEscala431454X18X642;        // int(12)  
    public $_431454X18X597;                   // string(150)  
    public $_valorEscala431454X18X597;        // int(12)  
    public $_431454X18X598;                   // string(150)  
    public $_valorEscala431454X18X598;        // int(12)  
    public $_431454X18X599;                   // string(150)  
    public $_valorEscala431454X18X599;        // int(12)  
    public $_431454X18X600;                   // string(150)  
    public $_valorEscala431454X18X600;        // int(12)  
    public $_431454X18X601;                   // string(150)  
    public $_valorEscala431454X18X601;        // int(12)  
    public $_431454X18X602;                   // string(150)  
    public $_valorEscala431454X18X602;        // int(12)  
    public $_431454X18X641;                   // string(150)  
    public $_valorEscala431454X18X641;        // int(12)  
    public $_431454X18X603;                   // string(150)  
    public $_valorEscala431454X18X603;        // int(12)  
    public $_431454X18X604;                   // string(150)  
    public $_valorEscala431454X18X604;        // int(12)  
    public $_431454X18X605;                   // string(150)  
    public $_valorEscala431454X18X605;        // int(12)  
    public $_431454X20X479;                   // string(150)  
    public $_valorEscala431454X20X479;        // int(12)  
    public $_431454X20X480;                   // string(150)  
    public $_valorEscala431454X20X480;        // int(12)  
    public $_431454X20X481;                   // string(150)  
    public $_valorEscala431454X20X481;        // int(12)  
    public $_431454X20X482;                   // string(150)  
    public $_valorEscala431454X20X482;        // int(12)  
    public $_431454X22X521SQ001;              // string(150)  
    public $_valorEscala431454X22X521SQ001;    // int(12)  
    public $_431454X22X521SQ002;              // string(150)  
    public $_valorEscala431454X22X521SQ002;    // int(12)  
    public $_431454X22X521SQ003;              // string(150)  
    public $_valorEscala431454X22X521SQ003;    // int(12)  
    public $_431454X22X521SQ004;              // string(150)  
    public $_valorEscala431454X22X521SQ004;    // int(12)  
    public $_431454X22X521SQ005;              // string(150)  
    public $_valorEscala431454X22X521SQ005;    // int(12)  
    public $_431454X22X521SQ006;              // string(150)  
    public $_valorEscala431454X22X521SQ006;    // int(12)  
    public $_431454X22X521SQ007;              // string(150)  
    public $_valorEscala431454X22X521SQ007;    // int(12)  
    public $_431454X22X521SQ008;              // string(150)  
    public $_valorEscala431454X22X521SQ008;    // int(12)  
    public $_431454X22X521SQ009;              // string(150)  
    public $_valorEscala431454X22X521SQ009;    // int(12)  
    public $_431454X22X521SQ010;              // string(150)  
    public $_valorEscala431454X22X521SQ010;    // int(12)  
    public $_431454X22X521SQ011;              // string(150)  
    public $_valorEscala431454X22X521SQ011;    // int(12)  
    public $_431454X22X521SQ012;              // string(150)  
    public $_valorEscala431454X22X521SQ012;    // int(12)  
    public $_431454X22X533;                   // string(150)  
    public $_valorEscala431454X22X533;        // int(12)  
    public $_431454X22X534SQ001;              // string(150)  
    public $_valorEscala431454X22X534SQ001;    // int(12)  
    public $_431454X22X534SQ002;              // string(150)  
    public $_valorEscala431454X22X534SQ002;    // int(12)  
    public $_431454X22X534SQ003;              // string(150)  
    public $_valorEscala431454X22X534SQ003;    // int(12)  
    public $_431454X22X534SQ004;              // string(150)  
    public $_valorEscala431454X22X534SQ004;    // int(12)  
    public $_431454X22X534SQ005;              // string(150)  
    public $_valorEscala431454X22X534SQ005;    // int(12)  
    public $_431454X22X534SQ006;              // string(150)  
    public $_valorEscala431454X22X534SQ006;    // int(12)  
    public $_431454X22X541;                   // string(150)  
    public $_valorEscala431454X22X541;        // int(12)  
    public $_431454X22X546;                   // string(150)  
    public $_valorEscala431454X22X546;        // int(12)  
    public $_431454X22X547;                   // string(150)  
    public $_valorEscala431454X22X547;        // int(12)  
    public $_431454X22X553SQ001;              // string(150)  
    public $_valorEscala431454X22X553SQ001;    // int(12)  
    public $_431454X22X553SQ002;              // string(150)  
    public $_valorEscala431454X22X553SQ002;    // int(12)  
    public $_431454X22X553SQ003;              // string(150)  
    public $_valorEscala431454X22X553SQ003;    // int(12)  
    public $_431454X22X553SQ004;              // string(150)  
    public $_valorEscala431454X22X553SQ004;    // int(12)  
    public $_431454X22X558;                   // string(150)  
    public $_valorEscala431454X22X558;        // int(12)  
    public $_431454X22X559;                   // string(150)  
    public $_valorEscala431454X22X559;        // int(12)  
    public $_431454X22X559comment;            // string(150)  
    public $_valorEscala431454X22X559comment;    // int(12)  
    public $_431454X25X618;                   // string(150)  
    public $_valorEscala431454X25X618;        // int(12)  
    public $_431454X25X619;                   // string(150)  
    public $_valorEscala431454X25X619;        // int(12)  
    public $_431454X25X620;                   // string(150)  
    public $_valorEscala431454X25X620;        // int(12)  
    public $_431454X25X622;                   // string(150)  
    public $_valorEscala431454X25X622;        // int(12)  
    public $_431454X25X623;                   // string(150)  
    public $_valorEscala431454X25X623;        // int(12)  
    public $_431454X25X624;                   // string(150)  
    public $_valorEscala431454X25X624;        // int(12)  
    public $_431454X25X625;                   // string(150)  
    public $_valorEscala431454X25X625;        // int(12)  
    public $_431454X25X626;                   // string(150)  
    public $_valorEscala431454X25X626;        // int(12)  
    public $_431454X25X627;                   // string(150)  
    public $_valorEscala431454X25X627;        // int(12)  
    public $_431454X25X628;                   // string(150)  
    public $_valorEscala431454X25X628;        // int(12)  
    public $_431454X26X629;                   // string(150)  
    public $_valorEscala431454X26X629;        // int(12)  
    public $_431454X26X630;                   // string(150)  
    public $_valorEscala431454X26X630;        // int(12)  
    public $_431454X26X631;                   // string(150)  
    public $_valorEscala431454X26X631;        // int(12)  
    public $_431454X26X632;                   // string(150)  
    public $_valorEscala431454X26X632;        // int(12)  
    public $_431454X26X633;                   // string(150)  
    public $_valorEscala431454X26X633;        // int(12)  
    public $_431454X26X634;                   // string(150)  
    public $_valorEscala431454X26X634;        // int(12)  
    public $_431454X26X635;                   // string(150)  
    public $_valorEscala431454X26X635;        // int(12)  
    public $_encuesta;                        // string(600)  
    public $_idEncuesta;                      // string(60)  
    public $_idAnswer;                        // int(12)  
    public $_indice;                          // string(30)  
    public $_estadoCorporal;                  // string(300)  
    public $_431454X14X655;                   // string(150)  
    public $_valorEscala431454X14X655;        // int(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_ViewHseq',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'valorEscalaid' =>  DB_DATAOBJECT_INT,
             'token' =>  DB_DATAOBJECT_STR,
             'valorEscalatoken' =>  DB_DATAOBJECT_INT,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'hora' =>  DB_DATAOBJECT_STR,
             'submitdateYMD' =>  DB_DATAOBJECT_STR,
             'ecografia' =>  DB_DATAOBJECT_STR,
             'mamografia' =>  DB_DATAOBJECT_STR,
             'citologia' =>  DB_DATAOBJECT_STR,
             'valorEscalasubmitdate' =>  DB_DATAOBJECT_INT,
             'lastpage' =>  DB_DATAOBJECT_STR,
             'valorEscalalastpage' =>  DB_DATAOBJECT_INT,
             'startlanguage' =>  DB_DATAOBJECT_STR,
             'valorEscalastartlanguage' =>  DB_DATAOBJECT_INT,
             'startdate' =>  DB_DATAOBJECT_STR,
             'valorEscalastartdate' =>  DB_DATAOBJECT_INT,
             'datestamp' =>  DB_DATAOBJECT_STR,
             'valorEscaladatestamp' =>  DB_DATAOBJECT_INT,
             'ipaddr' =>  DB_DATAOBJECT_STR,
             'valorEscalaipaddr' =>  DB_DATAOBJECT_INT,
             'refurl' =>  DB_DATAOBJECT_STR,
             'valorEscalarefurl' =>  DB_DATAOBJECT_INT,
             '431454X14X612' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X612' =>  DB_DATAOBJECT_INT,
             '431454X14X247' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X247' =>  DB_DATAOBJECT_INT,
             '431454X14X250' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X250' =>  DB_DATAOBJECT_INT,
             '431454X14X248' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X248' =>  DB_DATAOBJECT_INT,
             '431454X14X249' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X249' =>  DB_DATAOBJECT_INT,
             '431454X14X638' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X638' =>  DB_DATAOBJECT_INT,
             '431454X14X614' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X614' =>  DB_DATAOBJECT_INT,
             '431454X14X613' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X613' =>  DB_DATAOBJECT_INT,
             '431454X14X251' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X251' =>  DB_DATAOBJECT_INT,
             '431454X14X636' =>  DB_DATAOBJECT_INT,
             'valorEscala431454X14X636' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ001' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ001' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ002' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ002' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ003' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ003' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ004' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ004' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ005' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ005' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ006' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ006' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ007' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ007' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ008' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ008' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ009' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ009' =>  DB_DATAOBJECT_INT,
             '431454X15X410SQ010' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X410SQ010' =>  DB_DATAOBJECT_INT,
             '431454X15X420' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X420' =>  DB_DATAOBJECT_INT,
             '431454X15X421' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X421' =>  DB_DATAOBJECT_INT,
             '431454X15X569' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X569' =>  DB_DATAOBJECT_INT,
             '431454X15X570' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X570' =>  DB_DATAOBJECT_INT,
             '431454X15X571' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X571' =>  DB_DATAOBJECT_INT,
             '431454X15X572' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X572' =>  DB_DATAOBJECT_INT,
             '431454X15X573' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X573' =>  DB_DATAOBJECT_INT,
             '431454X15X574' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X574' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ001' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ001' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ002' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ002' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ003' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ003' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ004' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ004' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ005' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ005' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ006' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ006' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ007' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ007' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ008' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ008' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ009' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ009' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ010' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ010' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ011' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ011' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ012' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ012' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ013' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ013' =>  DB_DATAOBJECT_INT,
             '431454X15X422SQ014' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X422SQ014' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ001' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ001' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ002' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ002' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ003' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ003' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ004' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ004' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ005' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ005' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ006' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ006' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ007' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ007' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ008' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ008' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ009' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ009' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ010' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ010' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ011' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ011' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ012' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ012' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ013' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ013' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ014' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ014' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ015' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ015' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ016' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ016' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ017' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ017' =>  DB_DATAOBJECT_INT,
             '431454X15X437SQ018' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X437SQ018' =>  DB_DATAOBJECT_INT,
             '431454X15X455' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X455' =>  DB_DATAOBJECT_INT,
             '431454X15X456' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X456' =>  DB_DATAOBJECT_INT,
             '431454X15X457' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X457' =>  DB_DATAOBJECT_INT,
             '431454X15X458' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X458' =>  DB_DATAOBJECT_INT,
             '431454X15X459' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X459' =>  DB_DATAOBJECT_INT,
             '431454X15X460' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X460' =>  DB_DATAOBJECT_INT,
             '431454X15X461' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X461' =>  DB_DATAOBJECT_INT,
             '431454X15X462' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X15X462' =>  DB_DATAOBJECT_INT,
             '431454X18X351' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X351' =>  DB_DATAOBJECT_INT,
             '431454X18X639' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X639' =>  DB_DATAOBJECT_INT,
             '431454X18X576' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X576' =>  DB_DATAOBJECT_INT,
             '431454X18X577' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X577' =>  DB_DATAOBJECT_INT,
             '431454X18X578' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X578' =>  DB_DATAOBJECT_INT,
             '431454X18X583' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X583' =>  DB_DATAOBJECT_INT,
             '431454X18X640' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X640' =>  DB_DATAOBJECT_INT,
             '431454X18X584' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X584' =>  DB_DATAOBJECT_INT,
             '431454X18X585' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X585' =>  DB_DATAOBJECT_INT,
             '431454X18X586' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X586' =>  DB_DATAOBJECT_INT,
             '431454X18X587' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X587' =>  DB_DATAOBJECT_INT,
             '431454X18X588' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X588' =>  DB_DATAOBJECT_INT,
             '431454X18X589' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X589' =>  DB_DATAOBJECT_INT,
             '431454X18X590' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X590' =>  DB_DATAOBJECT_INT,
             '431454X18X591' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X591' =>  DB_DATAOBJECT_INT,
             '431454X18X592' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X592' =>  DB_DATAOBJECT_INT,
             '431454X18X593' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X593' =>  DB_DATAOBJECT_INT,
             '431454X18X594' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X594' =>  DB_DATAOBJECT_INT,
             '431454X18X595' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X595' =>  DB_DATAOBJECT_INT,
             '431454X18X596' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X596' =>  DB_DATAOBJECT_INT,
             '431454X18X642' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X642' =>  DB_DATAOBJECT_INT,
             '431454X18X597' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X597' =>  DB_DATAOBJECT_INT,
             '431454X18X598' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X598' =>  DB_DATAOBJECT_INT,
             '431454X18X599' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X599' =>  DB_DATAOBJECT_INT,
             '431454X18X600' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X600' =>  DB_DATAOBJECT_INT,
             '431454X18X601' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X601' =>  DB_DATAOBJECT_INT,
             '431454X18X602' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X602' =>  DB_DATAOBJECT_INT,
             '431454X18X641' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X641' =>  DB_DATAOBJECT_INT,
             '431454X18X603' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X603' =>  DB_DATAOBJECT_INT,
             '431454X18X604' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X604' =>  DB_DATAOBJECT_INT,
             '431454X18X605' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X18X605' =>  DB_DATAOBJECT_INT,
             '431454X20X479' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X20X479' =>  DB_DATAOBJECT_INT,
             '431454X20X480' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X20X480' =>  DB_DATAOBJECT_INT,
             '431454X20X481' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X20X481' =>  DB_DATAOBJECT_INT,
             '431454X20X482' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X20X482' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ001' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ001' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ002' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ002' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ003' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ003' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ004' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ004' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ005' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ005' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ006' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ006' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ007' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ007' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ008' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ008' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ009' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ009' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ010' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ010' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ011' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ011' =>  DB_DATAOBJECT_INT,
             '431454X22X521SQ012' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X521SQ012' =>  DB_DATAOBJECT_INT,
             '431454X22X533' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X533' =>  DB_DATAOBJECT_INT,
             '431454X22X534SQ001' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X534SQ001' =>  DB_DATAOBJECT_INT,
             '431454X22X534SQ002' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X534SQ002' =>  DB_DATAOBJECT_INT,
             '431454X22X534SQ003' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X534SQ003' =>  DB_DATAOBJECT_INT,
             '431454X22X534SQ004' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X534SQ004' =>  DB_DATAOBJECT_INT,
             '431454X22X534SQ005' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X534SQ005' =>  DB_DATAOBJECT_INT,
             '431454X22X534SQ006' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X534SQ006' =>  DB_DATAOBJECT_INT,
             '431454X22X541' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X541' =>  DB_DATAOBJECT_INT,
             '431454X22X546' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X546' =>  DB_DATAOBJECT_INT,
             '431454X22X547' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X547' =>  DB_DATAOBJECT_INT,
             '431454X22X553SQ001' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X553SQ001' =>  DB_DATAOBJECT_INT,
             '431454X22X553SQ002' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X553SQ002' =>  DB_DATAOBJECT_INT,
             '431454X22X553SQ003' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X553SQ003' =>  DB_DATAOBJECT_INT,
             '431454X22X553SQ004' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X553SQ004' =>  DB_DATAOBJECT_INT,
             '431454X22X558' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X558' =>  DB_DATAOBJECT_INT,
             '431454X22X559' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X559' =>  DB_DATAOBJECT_INT,
             '431454X22X559comment' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X22X559comment' =>  DB_DATAOBJECT_INT,
             '431454X25X618' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X618' =>  DB_DATAOBJECT_INT,
             '431454X25X619' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X619' =>  DB_DATAOBJECT_INT,
             '431454X25X620' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X620' =>  DB_DATAOBJECT_INT,
             '431454X25X622' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X622' =>  DB_DATAOBJECT_INT,
             '431454X25X623' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X623' =>  DB_DATAOBJECT_INT,
             '431454X25X624' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X624' =>  DB_DATAOBJECT_INT,
             '431454X25X625' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X625' =>  DB_DATAOBJECT_INT,
             '431454X25X626' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X626' =>  DB_DATAOBJECT_INT,
             '431454X25X627' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X627' =>  DB_DATAOBJECT_INT,
             '431454X25X628' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X25X628' =>  DB_DATAOBJECT_INT,
             '431454X26X629' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X629' =>  DB_DATAOBJECT_INT,
             '431454X26X630' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X630' =>  DB_DATAOBJECT_INT,
             '431454X26X631' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X631' =>  DB_DATAOBJECT_INT,
             '431454X26X632' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X632' =>  DB_DATAOBJECT_INT,
             '431454X26X633' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X633' =>  DB_DATAOBJECT_INT,
             '431454X26X634' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X634' =>  DB_DATAOBJECT_INT,
             '431454X26X635' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X26X635' =>  DB_DATAOBJECT_INT,
             'encuesta' =>  DB_DATAOBJECT_STR,
             'idEncuesta' =>  DB_DATAOBJECT_STR,
             'idAnswer' =>  DB_DATAOBJECT_INT,
             'indice' =>  DB_DATAOBJECT_STR,
             'estadoCorporal' =>  DB_DATAOBJECT_STR,
             '431454X14X655' =>  DB_DATAOBJECT_STR,
             'valorEscala431454X14X655' =>  DB_DATAOBJECT_INT,
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
             'token' => '',
             'hora' => '',
             'submitdateYMD' => '',
             'ecografia' => '',
             'mamografia' => '',
             'citologia' => '',
             'lastpage' => '',
             'startlanguage' => '',
             'startdate' => '',
             'datestamp' => '',
             'ipaddr' => '',
             'refurl' => '',
             '431454X14X612' => '',
             '431454X14X247' => '',
             '431454X14X250' => '',
             '431454X14X248' => '',
             '431454X14X249' => '',
             '431454X14X638' => '',
             '431454X14X614' => '',
             '431454X14X613' => '',
             '431454X14X251' => '',
             '431454X15X410SQ001' => '',
             '431454X15X410SQ002' => '',
             '431454X15X410SQ003' => '',
             '431454X15X410SQ004' => '',
             '431454X15X410SQ005' => '',
             '431454X15X410SQ006' => '',
             '431454X15X410SQ007' => '',
             '431454X15X410SQ008' => '',
             '431454X15X410SQ009' => '',
             '431454X15X410SQ010' => '',
             '431454X15X420' => '',
             '431454X15X421' => '',
             '431454X15X569' => '',
             '431454X15X570' => '',
             '431454X15X571' => '',
             '431454X15X572' => '',
             '431454X15X573' => '',
             '431454X15X574' => '',
             '431454X15X422SQ001' => '',
             '431454X15X422SQ002' => '',
             '431454X15X422SQ003' => '',
             '431454X15X422SQ004' => '',
             '431454X15X422SQ005' => '',
             '431454X15X422SQ006' => '',
             '431454X15X422SQ007' => '',
             '431454X15X422SQ008' => '',
             '431454X15X422SQ009' => '',
             '431454X15X422SQ010' => '',
             '431454X15X422SQ011' => '',
             '431454X15X422SQ012' => '',
             '431454X15X422SQ013' => '',
             '431454X15X422SQ014' => '',
             '431454X15X437SQ001' => '',
             '431454X15X437SQ002' => '',
             '431454X15X437SQ003' => '',
             '431454X15X437SQ004' => '',
             '431454X15X437SQ005' => '',
             '431454X15X437SQ006' => '',
             '431454X15X437SQ007' => '',
             '431454X15X437SQ008' => '',
             '431454X15X437SQ009' => '',
             '431454X15X437SQ010' => '',
             '431454X15X437SQ011' => '',
             '431454X15X437SQ012' => '',
             '431454X15X437SQ013' => '',
             '431454X15X437SQ014' => '',
             '431454X15X437SQ015' => '',
             '431454X15X437SQ016' => '',
             '431454X15X437SQ017' => '',
             '431454X15X437SQ018' => '',
             '431454X15X455' => '',
             '431454X15X456' => '',
             '431454X15X457' => '',
             '431454X15X458' => '',
             '431454X15X459' => '',
             '431454X15X460' => '',
             '431454X15X461' => '',
             '431454X15X462' => '',
             '431454X18X351' => '',
             '431454X18X639' => '',
             '431454X18X576' => '',
             '431454X18X577' => '',
             '431454X18X578' => '',
             '431454X18X583' => '',
             '431454X18X640' => '',
             '431454X18X584' => '',
             '431454X18X585' => '',
             '431454X18X586' => '',
             '431454X18X587' => '',
             '431454X18X588' => '',
             '431454X18X589' => '',
             '431454X18X590' => '',
             '431454X18X591' => '',
             '431454X18X592' => '',
             '431454X18X593' => '',
             '431454X18X594' => '',
             '431454X18X595' => '',
             '431454X18X596' => '',
             '431454X18X642' => '',
             '431454X18X597' => '',
             '431454X18X598' => '',
             '431454X18X599' => '',
             '431454X18X600' => '',
             '431454X18X601' => '',
             '431454X18X602' => '',
             '431454X18X641' => '',
             '431454X18X603' => '',
             '431454X18X604' => '',
             '431454X18X605' => '',
             '431454X20X479' => '',
             '431454X20X480' => '',
             '431454X20X481' => '',
             '431454X20X482' => '',
             '431454X22X521SQ001' => '',
             '431454X22X521SQ002' => '',
             '431454X22X521SQ003' => '',
             '431454X22X521SQ004' => '',
             '431454X22X521SQ005' => '',
             '431454X22X521SQ006' => '',
             '431454X22X521SQ007' => '',
             '431454X22X521SQ008' => '',
             '431454X22X521SQ009' => '',
             '431454X22X521SQ010' => '',
             '431454X22X521SQ011' => '',
             '431454X22X521SQ012' => '',
             '431454X22X533' => '',
             '431454X22X534SQ001' => '',
             '431454X22X534SQ002' => '',
             '431454X22X534SQ003' => '',
             '431454X22X534SQ004' => '',
             '431454X22X534SQ005' => '',
             '431454X22X534SQ006' => '',
             '431454X22X541' => '',
             '431454X22X546' => '',
             '431454X22X547' => '',
             '431454X22X553SQ001' => '',
             '431454X22X553SQ002' => '',
             '431454X22X553SQ003' => '',
             '431454X22X553SQ004' => '',
             '431454X22X558' => '',
             '431454X22X559' => '',
             '431454X22X559comment' => '',
             '431454X25X618' => '',
             '431454X25X619' => '',
             '431454X25X620' => '',
             '431454X25X622' => '',
             '431454X25X623' => '',
             '431454X25X624' => '',
             '431454X25X625' => '',
             '431454X25X626' => '',
             '431454X25X627' => '',
             '431454X25X628' => '',
             '431454X26X629' => '',
             '431454X26X630' => '',
             '431454X26X631' => '',
             '431454X26X632' => '',
             '431454X26X633' => '',
             '431454X26X634' => '',
             '431454X26X635' => '',
             'encuesta' => '',
             'idEncuesta' => '',
             'indice' => '',
             'estadoCorporal' => '',
             '431454X14X655' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

<?php
/**
 * Table Definition for lime_survey_642991_o
 */

class DataObjects_LimeSurvey642991O extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_survey_642991_o';            // table name
    public $_id;                              // int(11)  not_null primary_key auto_increment
    public $_submitdate;                      // datetime(19)  binary
    public $_lastpage;                        // int(11)  
    public $_startlanguage;                   // string(20)  not_null
    public $_ipaddr;                          // blob(65535)  blob
    public $_refurl;                          // blob(65535)  blob
    public $_642991X4X119;                    // string(5)  
    public $_642991X4X120;                    // string(5)  
    public $_642991X4X121;                    // string(5)  
    public $_642991X4X122;                    // string(5)  
    public $_642991X4X123;                    // string(5)  
    public $_642991X4X124;                    // string(1)  
    public $_642991X4X125;                    // string(5)  
    public $_642991X4X126;                    // string(5)  
    public $_642991X4X127;                    // string(5)  
    public $_642991X4X128;                    // string(5)  
    public $_642991X4X129;                    // real(32)  
    public $_642991X4X130;                    // real(32)  
    public $_642991X2X13;                     // string(5)  
    public $_642991X2X14;                     // string(5)  
    public $_642991X2X15;                     // string(5)  
    public $_642991X2X16;                     // string(5)  
    public $_642991X2X17;                     // string(5)  
    public $_642991X2X18;                     // string(5)  
    public $_642991X2X19;                     // string(5)  
    public $_642991X2X20;                     // string(5)  
    public $_642991X2X21;                     // string(5)  
    public $_642991X2X22;                     // string(5)  
    public $_642991X2X23;                     // string(5)  
    public $_642991X2X24;                     // string(5)  
    public $_642991X2X25;                     // string(5)  
    public $_642991X2X26;                     // string(5)  
    public $_642991X2X131;                    // string(5)  
    public $_642991X2X27;                     // string(5)  
    public $_642991X2X28;                     // string(5)  
    public $_642991X2X29;                     // string(5)  
    public $_642991X2X30;                     // string(5)  
    public $_642991X2X31;                     // string(5)  
    public $_642991X2X32;                     // string(5)  
    public $_642991X2X33;                     // string(5)  
    public $_642991X2X34;                     // string(5)  
    public $_642991X3X35;                     // string(5)  
    public $_642991X3X36;                     // string(5)  
    public $_642991X3X37;                     // string(5)  
    public $_642991X3X38;                     // string(5)  
    public $_642991X3X39;                     // string(5)  
    public $_642991X3X40;                     // string(5)  
    public $_642991X3X41;                     // string(5)  
    public $_642991X3X42;                     // string(5)  
    public $_642991X3X43;                     // string(5)  
    public $_642991X3X44;                     // string(5)  
    public $_642991X3X45;                     // string(5)  
    public $_642991X3X46;                     // string(5)  
    public $_642991X3X47;                     // string(5)  
    public $_642991X3X48;                     // string(5)  
    public $_642991X3X49;                     // string(5)  
    public $_642991X3X50;                     // string(5)  
    public $_642991X3X51;                     // string(5)  
    public $_642991X3X52;                     // string(5)  
    public $_642991X3X53;                     // string(5)  
    public $_642991X3X54;                     // string(5)  
    public $_642991X3X55;                     // string(5)  
    public $_642991X3X56;                     // string(5)  
    public $_642991X3X57;                     // string(5)  
    public $_642991X3X58;                     // string(5)  
    public $_642991X3X59;                     // string(5)  
    public $_642991X3X60;                     // string(5)  
    public $_642991X3X61;                     // string(5)  
    public $_642991X3X62;                     // string(5)  
    public $_642991X3X63;                     // string(5)  
    public $_642991X3X64;                     // string(5)  
    public $_642991X3X65;                     // string(5)  
    public $_642991X3X66;                     // string(5)  
    public $_642991X3X67;                     // string(5)  
    public $_642991X3X68;                     // string(5)  
    public $_642991X3X69;                     // string(5)  
    public $_642991X3X70;                     // string(5)  
    public $_642991X3X71;                     // string(5)  
    public $_642991X3X72;                     // string(5)  
    public $_642991X3X73;                     // string(5)  
    public $_642991X3X74;                     // string(5)  
    public $_642991X3X75;                     // string(5)  
    public $_642991X3X76;                     // string(5)  
    public $_642991X3X77;                     // string(5)  
    public $_642991X3X78;                     // string(5)  
    public $_642991X3X79;                     // string(5)  
    public $_642991X3X80;                     // string(5)  
    public $_642991X3X81;                     // string(5)  
    public $_642991X3X82;                     // string(5)  
    public $_642991X3X83;                     // string(5)  
    public $_642991X3X84;                     // string(5)  
    public $_642991X3X85;                     // string(5)  
    public $_642991X3X86;                     // string(5)  
    public $_642991X3X87;                     // string(5)  
    public $_642991X3X88;                     // string(5)  
    public $_642991X3X89;                     // string(5)  
    public $_642991X3X90;                     // string(5)  
    public $_642991X3X91;                     // string(5)  
    public $_642991X3X92;                     // string(5)  
    public $_642991X3X93;                     // string(5)  
    public $_642991X3X94;                     // string(5)  
    public $_642991X3X95;                     // string(5)  
    public $_642991X3X96;                     // string(5)  
    public $_642991X3X97;                     // string(5)  
    public $_642991X3X98;                     // string(5)  
    public $_642991X3X99;                     // string(5)  
    public $_642991X3X100;                    // string(5)  
    public $_642991X3X101;                    // string(5)  
    public $_642991X3X102;                    // string(5)  
    public $_642991X3X103;                    // string(5)  
    public $_642991X3X104;                    // string(5)  
    public $_642991X3X105;                    // string(5)  
    public $_642991X3X106;                    // string(5)  
    public $_642991X3X107;                    // string(5)  
    public $_642991X3X108;                    // string(5)  
    public $_642991X3X109;                    // string(5)  
    public $_642991X3X110;                    // string(5)  
    public $_642991X3X111;                    // string(5)  
    public $_642991X3X112;                    // string(5)  
    public $_642991X3X113;                    // string(5)  
    public $_642991X3X114;                    // string(5)  
    public $_642991X3X115;                    // string(5)  
    public $_642991X3X116;                    // string(5)  
    public $_642991X3X117;                    // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeSurvey642991O',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'lastpage' =>  DB_DATAOBJECT_INT,
             'startlanguage' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'ipaddr' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             'refurl' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
             '642991X4X119' =>  DB_DATAOBJECT_STR,
             '642991X4X120' =>  DB_DATAOBJECT_STR,
             '642991X4X121' =>  DB_DATAOBJECT_STR,
             '642991X4X122' =>  DB_DATAOBJECT_STR,
             '642991X4X123' =>  DB_DATAOBJECT_STR,
             '642991X4X124' =>  DB_DATAOBJECT_STR,
             '642991X4X125' =>  DB_DATAOBJECT_STR,
             '642991X4X126' =>  DB_DATAOBJECT_STR,
             '642991X4X127' =>  DB_DATAOBJECT_STR,
             '642991X4X128' =>  DB_DATAOBJECT_STR,
             '642991X4X129' =>  DB_DATAOBJECT_INT,
             '642991X4X130' =>  DB_DATAOBJECT_INT,
             '642991X2X13' =>  DB_DATAOBJECT_STR,
             '642991X2X14' =>  DB_DATAOBJECT_STR,
             '642991X2X15' =>  DB_DATAOBJECT_STR,
             '642991X2X16' =>  DB_DATAOBJECT_STR,
             '642991X2X17' =>  DB_DATAOBJECT_STR,
             '642991X2X18' =>  DB_DATAOBJECT_STR,
             '642991X2X19' =>  DB_DATAOBJECT_STR,
             '642991X2X20' =>  DB_DATAOBJECT_STR,
             '642991X2X21' =>  DB_DATAOBJECT_STR,
             '642991X2X22' =>  DB_DATAOBJECT_STR,
             '642991X2X23' =>  DB_DATAOBJECT_STR,
             '642991X2X24' =>  DB_DATAOBJECT_STR,
             '642991X2X25' =>  DB_DATAOBJECT_STR,
             '642991X2X26' =>  DB_DATAOBJECT_STR,
             '642991X2X131' =>  DB_DATAOBJECT_STR,
             '642991X2X27' =>  DB_DATAOBJECT_STR,
             '642991X2X28' =>  DB_DATAOBJECT_STR,
             '642991X2X29' =>  DB_DATAOBJECT_STR,
             '642991X2X30' =>  DB_DATAOBJECT_STR,
             '642991X2X31' =>  DB_DATAOBJECT_STR,
             '642991X2X32' =>  DB_DATAOBJECT_STR,
             '642991X2X33' =>  DB_DATAOBJECT_STR,
             '642991X2X34' =>  DB_DATAOBJECT_STR,
             '642991X3X35' =>  DB_DATAOBJECT_STR,
             '642991X3X36' =>  DB_DATAOBJECT_STR,
             '642991X3X37' =>  DB_DATAOBJECT_STR,
             '642991X3X38' =>  DB_DATAOBJECT_STR,
             '642991X3X39' =>  DB_DATAOBJECT_STR,
             '642991X3X40' =>  DB_DATAOBJECT_STR,
             '642991X3X41' =>  DB_DATAOBJECT_STR,
             '642991X3X42' =>  DB_DATAOBJECT_STR,
             '642991X3X43' =>  DB_DATAOBJECT_STR,
             '642991X3X44' =>  DB_DATAOBJECT_STR,
             '642991X3X45' =>  DB_DATAOBJECT_STR,
             '642991X3X46' =>  DB_DATAOBJECT_STR,
             '642991X3X47' =>  DB_DATAOBJECT_STR,
             '642991X3X48' =>  DB_DATAOBJECT_STR,
             '642991X3X49' =>  DB_DATAOBJECT_STR,
             '642991X3X50' =>  DB_DATAOBJECT_STR,
             '642991X3X51' =>  DB_DATAOBJECT_STR,
             '642991X3X52' =>  DB_DATAOBJECT_STR,
             '642991X3X53' =>  DB_DATAOBJECT_STR,
             '642991X3X54' =>  DB_DATAOBJECT_STR,
             '642991X3X55' =>  DB_DATAOBJECT_STR,
             '642991X3X56' =>  DB_DATAOBJECT_STR,
             '642991X3X57' =>  DB_DATAOBJECT_STR,
             '642991X3X58' =>  DB_DATAOBJECT_STR,
             '642991X3X59' =>  DB_DATAOBJECT_STR,
             '642991X3X60' =>  DB_DATAOBJECT_STR,
             '642991X3X61' =>  DB_DATAOBJECT_STR,
             '642991X3X62' =>  DB_DATAOBJECT_STR,
             '642991X3X63' =>  DB_DATAOBJECT_STR,
             '642991X3X64' =>  DB_DATAOBJECT_STR,
             '642991X3X65' =>  DB_DATAOBJECT_STR,
             '642991X3X66' =>  DB_DATAOBJECT_STR,
             '642991X3X67' =>  DB_DATAOBJECT_STR,
             '642991X3X68' =>  DB_DATAOBJECT_STR,
             '642991X3X69' =>  DB_DATAOBJECT_STR,
             '642991X3X70' =>  DB_DATAOBJECT_STR,
             '642991X3X71' =>  DB_DATAOBJECT_STR,
             '642991X3X72' =>  DB_DATAOBJECT_STR,
             '642991X3X73' =>  DB_DATAOBJECT_STR,
             '642991X3X74' =>  DB_DATAOBJECT_STR,
             '642991X3X75' =>  DB_DATAOBJECT_STR,
             '642991X3X76' =>  DB_DATAOBJECT_STR,
             '642991X3X77' =>  DB_DATAOBJECT_STR,
             '642991X3X78' =>  DB_DATAOBJECT_STR,
             '642991X3X79' =>  DB_DATAOBJECT_STR,
             '642991X3X80' =>  DB_DATAOBJECT_STR,
             '642991X3X81' =>  DB_DATAOBJECT_STR,
             '642991X3X82' =>  DB_DATAOBJECT_STR,
             '642991X3X83' =>  DB_DATAOBJECT_STR,
             '642991X3X84' =>  DB_DATAOBJECT_STR,
             '642991X3X85' =>  DB_DATAOBJECT_STR,
             '642991X3X86' =>  DB_DATAOBJECT_STR,
             '642991X3X87' =>  DB_DATAOBJECT_STR,
             '642991X3X88' =>  DB_DATAOBJECT_STR,
             '642991X3X89' =>  DB_DATAOBJECT_STR,
             '642991X3X90' =>  DB_DATAOBJECT_STR,
             '642991X3X91' =>  DB_DATAOBJECT_STR,
             '642991X3X92' =>  DB_DATAOBJECT_STR,
             '642991X3X93' =>  DB_DATAOBJECT_STR,
             '642991X3X94' =>  DB_DATAOBJECT_STR,
             '642991X3X95' =>  DB_DATAOBJECT_STR,
             '642991X3X96' =>  DB_DATAOBJECT_STR,
             '642991X3X97' =>  DB_DATAOBJECT_STR,
             '642991X3X98' =>  DB_DATAOBJECT_STR,
             '642991X3X99' =>  DB_DATAOBJECT_STR,
             '642991X3X100' =>  DB_DATAOBJECT_STR,
             '642991X3X101' =>  DB_DATAOBJECT_STR,
             '642991X3X102' =>  DB_DATAOBJECT_STR,
             '642991X3X103' =>  DB_DATAOBJECT_STR,
             '642991X3X104' =>  DB_DATAOBJECT_STR,
             '642991X3X105' =>  DB_DATAOBJECT_STR,
             '642991X3X106' =>  DB_DATAOBJECT_STR,
             '642991X3X107' =>  DB_DATAOBJECT_STR,
             '642991X3X108' =>  DB_DATAOBJECT_STR,
             '642991X3X109' =>  DB_DATAOBJECT_STR,
             '642991X3X110' =>  DB_DATAOBJECT_STR,
             '642991X3X111' =>  DB_DATAOBJECT_STR,
             '642991X3X112' =>  DB_DATAOBJECT_STR,
             '642991X3X113' =>  DB_DATAOBJECT_STR,
             '642991X3X114' =>  DB_DATAOBJECT_STR,
             '642991X3X115' =>  DB_DATAOBJECT_STR,
             '642991X3X116' =>  DB_DATAOBJECT_STR,
             '642991X3X117' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_BLOB,
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
             'startlanguage' => '',
             'ipaddr' => '',
             'refurl' => '',
             '642991X4X119' => '',
             '642991X4X120' => '',
             '642991X4X121' => '',
             '642991X4X122' => '',
             '642991X4X123' => '',
             '642991X4X124' => '',
             '642991X4X125' => '',
             '642991X4X126' => '',
             '642991X4X127' => '',
             '642991X4X128' => '',
             '642991X2X13' => '',
             '642991X2X14' => '',
             '642991X2X15' => '',
             '642991X2X16' => '',
             '642991X2X17' => '',
             '642991X2X18' => '',
             '642991X2X19' => '',
             '642991X2X20' => '',
             '642991X2X21' => '',
             '642991X2X22' => '',
             '642991X2X23' => '',
             '642991X2X24' => '',
             '642991X2X25' => '',
             '642991X2X26' => '',
             '642991X2X131' => '',
             '642991X2X27' => '',
             '642991X2X28' => '',
             '642991X2X29' => '',
             '642991X2X30' => '',
             '642991X2X31' => '',
             '642991X2X32' => '',
             '642991X2X33' => '',
             '642991X2X34' => '',
             '642991X3X35' => '',
             '642991X3X36' => '',
             '642991X3X37' => '',
             '642991X3X38' => '',
             '642991X3X39' => '',
             '642991X3X40' => '',
             '642991X3X41' => '',
             '642991X3X42' => '',
             '642991X3X43' => '',
             '642991X3X44' => '',
             '642991X3X45' => '',
             '642991X3X46' => '',
             '642991X3X47' => '',
             '642991X3X48' => '',
             '642991X3X49' => '',
             '642991X3X50' => '',
             '642991X3X51' => '',
             '642991X3X52' => '',
             '642991X3X53' => '',
             '642991X3X54' => '',
             '642991X3X55' => '',
             '642991X3X56' => '',
             '642991X3X57' => '',
             '642991X3X58' => '',
             '642991X3X59' => '',
             '642991X3X60' => '',
             '642991X3X61' => '',
             '642991X3X62' => '',
             '642991X3X63' => '',
             '642991X3X64' => '',
             '642991X3X65' => '',
             '642991X3X66' => '',
             '642991X3X67' => '',
             '642991X3X68' => '',
             '642991X3X69' => '',
             '642991X3X70' => '',
             '642991X3X71' => '',
             '642991X3X72' => '',
             '642991X3X73' => '',
             '642991X3X74' => '',
             '642991X3X75' => '',
             '642991X3X76' => '',
             '642991X3X77' => '',
             '642991X3X78' => '',
             '642991X3X79' => '',
             '642991X3X80' => '',
             '642991X3X81' => '',
             '642991X3X82' => '',
             '642991X3X83' => '',
             '642991X3X84' => '',
             '642991X3X85' => '',
             '642991X3X86' => '',
             '642991X3X87' => '',
             '642991X3X88' => '',
             '642991X3X89' => '',
             '642991X3X90' => '',
             '642991X3X91' => '',
             '642991X3X92' => '',
             '642991X3X93' => '',
             '642991X3X94' => '',
             '642991X3X95' => '',
             '642991X3X96' => '',
             '642991X3X97' => '',
             '642991X3X98' => '',
             '642991X3X99' => '',
             '642991X3X100' => '',
             '642991X3X101' => '',
             '642991X3X102' => '',
             '642991X3X103' => '',
             '642991X3X104' => '',
             '642991X3X105' => '',
             '642991X3X106' => '',
             '642991X3X107' => '',
             '642991X3X108' => '',
             '642991X3X109' => '',
             '642991X3X110' => '',
             '642991X3X111' => '',
             '642991X3X112' => '',
             '642991X3X113' => '',
             '642991X3X114' => '',
             '642991X3X115' => '',
             '642991X3X116' => '',
             '642991X3X117' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

<?php
/**
 * Table Definition for view_participantes
 */

class DataObjects_ViewParticipantes extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'view_participantes';              // table name
    public $_id;                              // int(12)  not_null
    public $_documento;                       // string(90)  
    public $_nombre;                          // string(600)  
    public $_CorreoCorporativo;               // string(600)  
    public $_NombreResponsable;               // string(450)  
    public $_UsuarioResponsable;              // string(150)  
    public $_IDResponsable;                   // string(60)  
    public $_CodLocalizacion;                 // string(150)  
    public $_Vicepresidencia;                 // string(300)  
    public $_gerencia;                        // string(300)  
    public $_Empresa;                         // string(300)  
    public $_UnidadNegocio;                   // string(300)  
    public $_Cargo;                           // string(60)  
    public $_Nombreposicion;                  // string(600)  
    public $_tipodocumento;                   // string(150)  
    public $_submitdate;                      // datetime(19)  binary
    public $_431454X14X613;                   // string(150)  
    public $_431454X14X612;                   // string(150)  
    public $_431454X14X251;                   // string(150)  
    public $_431454X14X250;                   // string(150)  
    public $_431454X14X655;                   // string(150)  
    public $_431454X14X247;                   // string(150)  
    public $_estado;                          // string(36)  not_null
    public $_431454X14X636;                   // int(12)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_ViewParticipantes',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'documento' =>  DB_DATAOBJECT_STR,
             'nombre' =>  DB_DATAOBJECT_STR,
             'CorreoCorporativo' =>  DB_DATAOBJECT_STR,
             'NombreResponsable' =>  DB_DATAOBJECT_STR,
             'UsuarioResponsable' =>  DB_DATAOBJECT_STR,
             'IDResponsable' =>  DB_DATAOBJECT_STR,
             'CodLocalizacion' =>  DB_DATAOBJECT_STR,
             'Vicepresidencia' =>  DB_DATAOBJECT_STR,
             'gerencia' =>  DB_DATAOBJECT_STR,
             'Empresa' =>  DB_DATAOBJECT_STR,
             'UnidadNegocio' =>  DB_DATAOBJECT_STR,
             'Cargo' =>  DB_DATAOBJECT_STR,
             'Nombreposicion' =>  DB_DATAOBJECT_STR,
             'tipodocumento' =>  DB_DATAOBJECT_STR,
             'submitdate' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             '431454X14X613' =>  DB_DATAOBJECT_STR,
             '431454X14X612' =>  DB_DATAOBJECT_STR,
             '431454X14X251' =>  DB_DATAOBJECT_STR,
             '431454X14X250' =>  DB_DATAOBJECT_STR,
             '431454X14X655' =>  DB_DATAOBJECT_STR,
             '431454X14X247' =>  DB_DATAOBJECT_STR,
             'estado' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             '431454X14X636' =>  DB_DATAOBJECT_INT,
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
             'documento' => '',
             'nombre' => '',
             'CorreoCorporativo' => '',
             'NombreResponsable' => '',
             'UsuarioResponsable' => '',
             'IDResponsable' => '',
             'CodLocalizacion' => '',
             'Vicepresidencia' => '',
             'gerencia' => '',
             'Empresa' => '',
             'UnidadNegocio' => '',
             'Cargo' => '',
             'Nombreposicion' => '',
             'tipodocumento' => '',
             '431454X14X613' => '',
             '431454X14X612' => '',
             '431454X14X251' => '',
             '431454X14X250' => '',
             '431454X14X655' => '',
             '431454X14X247' => '',
             'estado' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

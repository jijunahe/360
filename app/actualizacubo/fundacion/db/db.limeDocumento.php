<?php
/**
 * Table Definition for lime_documento
 */

class DataObjects_LimeDocumento extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lime_documento';                  // table name
    public $_id;                              // int(12)  not_null primary_key auto_increment
    public $_documento;                       // string(30)  
    public $_nombre;                          // string(200)  
    public $_estado;                          // string(1)  enum
    public $_fecharegistro;                   // datetime(19)  binary
    public $_tipodocumento;                   // string(50)  
    public $_nombre1;                         // string(100)  
    public $_Apellidos;                       // string(150)  
    public $_Nombreposicion;                  // string(200)  
    public $_Cargo;                           // string(20)  
    public $_nombre2;                         // string(100)  
    public $_Empresa;                         // string(100)  
    public $_gerencia;                        // string(100)  
    public $_Vicepresidencia;                 // string(100)  
    public $_CodLocalizacion;                 // string(50)  
    public $_IDResponsable;                   // string(20)  
    public $_UsuarioResponsable;              // string(50)  
    public $_NombreResponsable;               // string(150)  
    public $_CorreoCorporativo;               // string(200)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_LimeDocumento',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'documento' =>  DB_DATAOBJECT_STR,
             'nombre' =>  DB_DATAOBJECT_STR,
             'estado' =>  DB_DATAOBJECT_STR,
             'fecharegistro' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'tipodocumento' =>  DB_DATAOBJECT_STR,
             'nombre1' =>  DB_DATAOBJECT_STR,
             'Apellidos' =>  DB_DATAOBJECT_STR,
             'Nombreposicion' =>  DB_DATAOBJECT_STR,
             'Cargo' =>  DB_DATAOBJECT_STR,
             'nombre2' =>  DB_DATAOBJECT_STR,
             'Empresa' =>  DB_DATAOBJECT_STR,
             'gerencia' =>  DB_DATAOBJECT_STR,
             'Vicepresidencia' =>  DB_DATAOBJECT_STR,
             'CodLocalizacion' =>  DB_DATAOBJECT_STR,
             'IDResponsable' =>  DB_DATAOBJECT_STR,
             'UsuarioResponsable' =>  DB_DATAOBJECT_STR,
             'NombreResponsable' =>  DB_DATAOBJECT_STR,
             'CorreoCorporativo' =>  DB_DATAOBJECT_STR,
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
             'documento' => '',
             'nombre' => '',
             'estado' => 'N',
             'tipodocumento' => '',
             'nombre1' => '',
             'Apellidos' => '',
             'Nombreposicion' => '',
             'Cargo' => '',
             'nombre2' => '',
             'Empresa' => '',
             'gerencia' => '',
             'Vicepresidencia' => '',
             'CodLocalizacion' => '',
             'IDResponsable' => '',
             'UsuarioResponsable' => '',
             'NombreResponsable' => '',
             'CorreoCorporativo' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

<?php

/**
 * This is the model class for table "{{ana_usuario}}".
 *
 * The followings are the available columns in table '{{ana_usuario}}':
 * @property integer $id
 * @property string $tokenid
 * @property integer $perfil
 * @property string $id_unidad
 * @property integer $id_area
 * @property integer $id_cargo
 * @property string $alias
 * @property string $clave
 * @property string $documento
 * @property string $email
 * @property string $uid_creador
 * @property integer $activo
 * @property string $fecharegistro 
 */
class AnaUsuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_usuario}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('perfil, alias, clave, documento, activo', 'required'),
			array('perfil, id_area, id_cargo, activo,idorgmenuserv', 'numerical', 'integerOnly'=>true),
			array('id_unidad', 'length', 'max'=>200),
			array('nombres', 'length', 'max'=>255),
			array('alias', 'length', 'max'=>64),
			array('clave, documento', 'length', 'max'=>20),
			array('email', 'length', 'max'=>50),
			array('uid_creador', 'length', 'max'=>11),
			array('tokenid, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,nombres, tokenid, perfil, id_unidad, id_area, id_cargo, alias, clave, documento, email, uid_creador, activo, fecharegistro,idorgmenuserv', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombres' => 'Nombres',
			'tokenid' => 'Tokenid',
			'perfil' => 'Perfil',
			'id_unidad' => 'Id Unidad',
			'id_area' => 'Id Area',
			'id_cargo' => 'Id Cargo',
			'alias' => 'Alias',
			'clave' => 'Clave',
			'documento' => 'Documento',
			'email' => 'Email',
			'uid_creador' => 'Uid Creador',
			'activo' => 'Activo',
			'fecharegistro' => 'Fecharegistro',
			'idorgmenuserv' => 'Id empresa para servicio',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */


	
	function selectAlias($alias){
 		$res = "";
        $queryString =sprintf("
		SELECT 
		alias
		FROM {{ana_usuario}}
		WHERE alias LIKE BINARY %s","'".$alias."'");
        
   		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		$dato="";
		foreach($res as $datos) {
 			$data= utf8_encode($row->alias);
 		}
 		if($alias==$data){
			 $res=$data;
		
		}else{
			$res = "OK";
		
		}
 		return $res;
    }
	
	function vaidausr($id){
	
		$par_id = $id;
 		$queryc = "SELECT * FROM {{users}} where uid=".(int)Yii::app()->user->id;
		$gcrt = dbExecuteAssoc($queryc);
		$ussurvey = $gcrt->readAll();
		
		
		$queryc = "SELECT * FROM {{ana_usuario}} where id=".(int)$ussurvey[0]["iduseval"];
		$gcrt = dbExecuteAssoc($queryc);
		$user = $gcrt->readAll();

		$msg="NO";
   		if(($user[0]["perfil"]==1 or $user[0]["perfil"]==3) or Permission::model()->getanOterpermision()){
			$msg= "OK";
 		}
		else{
			if($par_id!=false){	
				$queryc = "SELECT * FROM {{ana_usuario}} where id=".(int)$par_id;
				$gcrt = dbExecuteAssoc($queryc);
				$user = $gcrt->readAll();
				if($ussurvey[0]["iduseval"]==$user[0]["id"]){
					$msg= "OK";
				}else{
					$msg= "No tiene permiso realizar esta acción"; 
				}
			}else{
				$msg= "No tiene permiso realizar esta acción"; 
 			}
			 
 		}
 		return $msg;
   		
	}	
	
  
	
	 
	 
	 
	 
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('tokenid',$this->tokenid,true);
		$criteria->compare('perfil',$this->perfil);
		$criteria->compare('id_unidad',$this->id_unidad,true);
		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('id_cargo',$this->id_cargo);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('clave',$this->clave,true);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('uid_creador',$this->uid_creador,true);
		$criteria->compare('idorgmenuserv',$this->idorgmenuserv,true);
		$criteria->compare('activo',$this->activo); 
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "{{ana_proyecto}}".
 *
 * The followings are the available columns in table '{{ana_proyecto}}':
 * @property string $keyid
 * @property string $nombre
 * @property string $clave
 * @property integer $idUsuario
 * @property string $fechacreacion
 * @property string $fechaactualizacion
 * @property integer $idUsuarioact
 * @property string $asignacion
 * @property string $tipoencuesta
 * @property integer $tipoproyecto
 * @property string $bienvenida
 * @property string $email
 * @property integer $id_pais
 * @property integer $id_region
 * @property integer $id_ciudad
 * @property string $id_empresa
 * @property string $estado
 */
class AnaProyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_proyecto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyid, fechacreacion', 'required'),
			array('idUsuario, idUsuarioact, tipoproyecto, id_pais, id_region, id_ciudad', 'numerical', 'integerOnly'=>true),
			array('keyid, clave', 'length', 'max'=>100),
			array('nombre', 'length', 'max'=>50),
			array('tipoencuesta', 'length', 'max'=>9),
			array('email', 'length', 'max'=>200),
			array('id_empresa', 'length', 'max'=>500),
			array('estado', 'length', 'max'=>1),
			array('fechaactualizacion, asignacion, bienvenida', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keyid, nombre, clave, idUsuario, fechacreacion, fechaactualizacion, idUsuarioact, asignacion, tipoencuesta, tipoproyecto, bienvenida, email, id_pais, id_region, id_ciudad, id_empresa, estado', 'safe', 'on'=>'search'),
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
			'keyid' => 'Keyid',
			'nombre' => 'Nombre',
			'clave' => 'Clave',
			'idUsuario' => 'Id Usuario',
			'fechacreacion' => 'Fechacreacion',
			'fechaactualizacion' => 'Fechaactualizacion',
			'idUsuarioact' => 'Id Usuarioact',
			'asignacion' => 'Asignacion',
			'tipoencuesta' => 'Tipoencuesta',
			'tipoproyecto' => 'Tipoproyecto',
			'bienvenida' => 'Bienvenida',
			'email' => 'Email',
			'id_pais' => 'Id Pais',
			'id_region' => 'Id Region',
			'id_ciudad' => 'Id Ciudad',
			'id_empresa' => 'Id Empresa',
			'estado' => 'Estado',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('keyid',$this->keyid,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('clave',$this->clave,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);
		$criteria->compare('idUsuarioact',$this->idUsuarioact);
		$criteria->compare('asignacion',$this->asignacion,true);
		$criteria->compare('tipoencuesta',$this->tipoencuesta,true);
		$criteria->compare('tipoproyecto',$this->tipoproyecto);
		$criteria->compare('bienvenida',$this->bienvenida,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_pais',$this->id_pais);
		$criteria->compare('id_region',$this->id_region);
		$criteria->compare('id_ciudad',$this->id_ciudad);
		$criteria->compare('id_empresa',$this->id_empresa,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaProyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

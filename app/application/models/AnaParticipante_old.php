<?php

/**
 * This is the model class for table "{{ana_participante}}".
 *
 * The followings are the available columns in table '{{ana_participante}}':
 * @property string $keyid
 * @property string $apellido
 * @property string $nombre
 * @property string $email
 * @property string $usuario
 * @property string $clave
 * @property integer $idUsuario
 * @property string $keyproyecto
 * @property string $fecharegistro
 * @property string $retroalimentacion
 * @property string $jsoncompetencias
 * @property string $fechaactualizacion
 */
class AnaParticipante extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_participante}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyid, jsoncompetencias', 'required'),
			array('idUsuario', 'numerical', 'integerOnly'=>true),
			array('keyid, apellido, nombre, email, usuario, keyproyecto', 'length', 'max'=>100),
			array('clave', 'length', 'max'=>200),
			array('retroalimentacion', 'length', 'max'=>1),
			array('fecharegistro, fechaactualizacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keyid, apellido, nombre, email, usuario, clave, idUsuario, keyproyecto, fecharegistro, retroalimentacion, jsoncompetencias, fechaactualizacion', 'safe', 'on'=>'search'),
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
			'apellido' => 'Apellido',
			'nombre' => 'Nombre',
			'email' => 'Email',
			'usuario' => 'Usuario',
			'clave' => 'Clave',
			'idUsuario' => 'Id Usuario',
			'keyproyecto' => 'Keyproyecto',
			'fecharegistro' => 'Fecharegistro',
			'retroalimentacion' => 'Retroalimentacion',
			'jsoncompetencias' => 'Jsoncompetencias',
			'fechaactualizacion' => 'Fechaactualizacion',
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
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('clave',$this->clave,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('keyproyecto',$this->keyproyecto,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('retroalimentacion',$this->retroalimentacion,true);
		$criteria->compare('jsoncompetencias',$this->jsoncompetencias,true);
		$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaParticipante the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

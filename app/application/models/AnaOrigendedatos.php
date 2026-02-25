<?php

/**
 * This is the model class for table "{{ana_origendedatos}}".
 *
 * The followings are the available columns in table '{{ana_origendedatos}}':
 * @property integer $id
 * @property integer $id_motor
 * @property string $nombre
 * @property string $origendedatos
 * @property string $usuario
 * @property string $password
 * @property string $puerto
 * @property integer $id_usuario
 * @property integer $id_empresa
 * @property string $fecha
 * @property string $ip
 */
class AnaOrigendedatos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_origendedatos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_motor, id_usuario, id_empresa', 'numerical', 'integerOnly'=>true),
			array('nombre, usuario, password', 'length', 'max'=>200),
			array('origendedatos', 'length', 'max'=>200), 
			array('puerto', 'length', 'max'=>10),
			array('ip', 'length', 'max'=>500),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_motor, nombre, origendedatos, usuario, password, puerto, id_usuario, id_empresa, fecha, ip', 'safe', 'on'=>'search'),
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
			'id_motor' => 'Id Motor',
			'nombre' => 'Nombre',
			'origendedatos' => 'Origendedatos',
			'usuario' => 'Usuario',
			'password' => 'Password',
			'puerto' => 'Puerto',
			'id_usuario' => 'Id Usuario',
			'id_empresa' => 'Id Empresa',
			'fecha' => 'Fecha',
			'ip' => 'Ip',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_motor',$this->id_motor);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('origendedatos',$this->origendedatos,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('puerto',$this->puerto,true);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('id_empresa',$this->id_empresa);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaOrigendedatos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

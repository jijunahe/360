<?php

/**
 * This is the model class for table "{{servicio}}".
 *
 * The followings are the available columns in table '{{servicio}}':
 * @property integer $id
 * @property string $nombre
 * @property string $jmodulos
 * @property string $descripcion
 * @property string $estado
 * @property string $fecharegistro
 * @property integer $idorganizacion
 * @property string $demo
 */
class Servicio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{servicio}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idorganizacion', 'numerical', 'integerOnly'=>true),
			array('nombre, jmodulos, descripcion', 'length', 'max'=>255),
			array('estado, demo', 'length', 'max'=>1),
			array('fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, jmodulos, descripcion, estado, fecharegistro, idorganizacion, demo', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
			'jmodulos' => 'Jmodulos',
			'descripcion' => 'Descripcion',
			'estado' => 'Estado',
			'fecharegistro' => 'Fecharegistro',
			'idorganizacion' => 'Idorganizacion',
			'demo' => 'Demo',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('jmodulos',$this->jmodulos,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('idorganizacion',$this->idorganizacion);
		$criteria->compare('demo',$this->demo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Servicio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

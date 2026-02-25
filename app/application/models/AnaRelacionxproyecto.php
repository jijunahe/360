<?php

/**
 * This is the model class for table "{{ana_relacionxproyecto}}".
 *
 * The followings are the available columns in table '{{ana_relacionxproyecto}}':
 * @property string $keyid
 * @property string $nombre
 * @property string $abreviacion
 * @property string $descripcion
 * @property string $keyproyecto
 * @property integer $idUsuario
 * @property string $fechacreacion
 * @property integer $idorigen
 * @property string $estado
 * @property string $color
 * @property string $fechaactualizacion
 */
class AnaRelacionxproyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_relacionxproyecto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyid', 'required'),
			array('idUsuario, idorigen', 'numerical', 'integerOnly'=>true),
			array('keyid, keyproyecto', 'length', 'max'=>200),
			array('nombre', 'length', 'max'=>100),
			array('abreviacion', 'length', 'max'=>6),
			array('estado', 'length', 'max'=>1),
			array('color', 'length', 'max'=>20),
			array('descripcion, fechacreacion, fechaactualizacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keyid, nombre, abreviacion, descripcion, keyproyecto, idUsuario, fechacreacion, idorigen, estado, color, fechaactualizacion', 'safe', 'on'=>'search'),
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
			'abreviacion' => 'Abreviacion',
			'descripcion' => 'Descripcion',
			'keyproyecto' => 'Keyproyecto',
			'idUsuario' => 'Id Usuario',
			'fechacreacion' => 'Fechacreacion',
			'idorigen' => 'Idorigen',
			'estado' => 'Estado',
			'color' => 'Color',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('abreviacion',$this->abreviacion,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('keyproyecto',$this->keyproyecto,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('idorigen',$this->idorigen);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaRelacionxproyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

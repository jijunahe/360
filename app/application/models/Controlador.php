<?php

/**
 * This is the model class for table "{{controlador}}".
 *
 * The followings are the available columns in table '{{controlador}}':
 * @property integer $id
 * @property string $prefijo
 * @property string $archivo
 * @property string $clase
 * @property string $descripcion
 * @property string $fecharegistro
 */
class Controlador extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{controlador}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prefijo, clase, descripcion', 'length', 'max'=>255),
			array('archivo', 'length', 'max'=>50),
			array('fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, prefijo, archivo, clase, descripcion, fecharegistro', 'safe', 'on'=>'search'),
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
			'prefijo' => 'Prefijo',
			'archivo' => 'Archivo',
			'clase' => 'Clase',
			'descripcion' => 'Descripcion',
			'fecharegistro' => 'Fecharegistro',
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
		$criteria->compare('prefijo',$this->prefijo,true);
		$criteria->compare('archivo',$this->archivo,true);
		$criteria->compare('clase',$this->clase,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Controlador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

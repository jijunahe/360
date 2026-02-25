<?php

/**
 * This is the model class for table "{{dimension_encuesta}}".
 *
 * The followings are the available columns in table '{{dimension_encuesta}}':
 * @property integer $id
 * @property string $nombre
 * @property string $codigo
 * @property integer $domid
 * @property integer $paramid
 * @property integer $sid
 * @property integer $qid
 * @property integer $transformacion
 * @property string $tipocal
 * @property string $fecha
 * @property integer $multiplicador
 */
class DimensionEncuesta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dimension_encuesta}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domid, paramid, sid, qid, transformacion, multiplicador', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('codigo', 'length', 'max'=>20),
			array('tipocal', 'length', 'max'=>1),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, codigo, domid, paramid, sid, qid, transformacion, tipocal, fecha, multiplicador', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
			'domid' => 'Domid',
			'paramid' => 'Paramid',
			'sid' => 'Sid',
			'qid' => 'Qid',
			'transformacion' => 'Transformacion',
			'tipocal' => 'Tipocal',
			'fecha' => 'Fecha',
			'multiplicador' => 'Multiplicador',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('domid',$this->domid);
		$criteria->compare('paramid',$this->paramid);
		$criteria->compare('sid',$this->sid);
		$criteria->compare('qid',$this->qid);
		$criteria->compare('transformacion',$this->transformacion);
		$criteria->compare('tipocal',$this->tipocal,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('multiplicador',$this->multiplicador);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DimensionEncuesta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "{{programacion_encuesta}}".
 *
 * The followings are the available columns in table '{{programacion_encuesta}}':
 * @property integer $id
 * @property integer $sid
 * @property string $fechaini
 * @property string $fechafin
 * @property integer $iduscrea
 * @property integer $id_area
 * @property string $descripcion
 * @property integer $ctriteriotransformacion
 * @property string $fechacreacion
 * @property string $fechaactualizacion
 * @property integer $idbateria
 * @property integer $id_unidad
 */
class ProgramacionEncuesta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{programacion_encuesta}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, iduscrea, id_area, ctriteriotransformacion, idbateria, id_unidad', 'numerical', 'integerOnly'=>true),
			array('fechaini, fechafin, descripcion, fechacreacion, fechaactualizacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sid, fechaini, fechafin, iduscrea, id_area, descripcion, ctriteriotransformacion, fechacreacion, fechaactualizacion, idbateria, id_unidad', 'safe', 'on'=>'search'),
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
			'sid' => 'Sid',
			'fechaini' => 'Fechaini',
			'fechafin' => 'Fechafin',
			'iduscrea' => 'Iduscrea',
			'id_area' => 'Id Area',
			'descripcion' => 'Descripcion',
			'ctriteriotransformacion' => 'Ctriteriotransformacion',
			'fechacreacion' => 'Fechacreacion',
			'fechaactualizacion' => 'Fechaactualizacion',
			'idbateria' => 'Idbateria',
			'id_unidad' => 'Id Unidad',
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
		$criteria->compare('sid',$this->sid);
		$criteria->compare('fechaini',$this->fechaini,true);
		$criteria->compare('fechafin',$this->fechafin,true);
		$criteria->compare('iduscrea',$this->iduscrea);
		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('ctriteriotransformacion',$this->ctriteriotransformacion);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);
		$criteria->compare('idbateria',$this->idbateria);
		$criteria->compare('id_unidad',$this->id_unidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProgramacionEncuesta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

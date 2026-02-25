<?php

/**
 * This is the model class for table "{{eval_control}}".
 *
 * The followings are the available columns in table '{{eval_control}}':
 * @property integer $id
 * @property integer $idperiodo
 * @property integer $usid
 * @property integer $evalid
 * @property integer $idsid
 * @property integer $sid
 * @property string $fecha
 * @property string $submitdate
 * @property integer $idaEncuestar
 */
class EvalControl extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_control}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idperiodo, usid, evalid, idsid, sid, idaEncuestar', 'numerical', 'integerOnly'=>true),
			array('fecha, submitdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idperiodo, usid, evalid, idsid, sid, fecha, submitdate, idaEncuestar,tipo', 'safe', 'on'=>'search'),
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
			'idperiodo' => 'Idperiodo',
			'usid' => 'Usid',
			'evalid' => 'Evalid',
			'idsid' => 'Idsid',
			'sid' => 'Sid',
			'fecha' => 'Fecha',
			'submitdate' => 'Submitdate',
			'idaEncuestar' => 'Ida Encuestar',
			'tipo' => 'tipo',
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
		$criteria->compare('idperiodo',$this->idperiodo);
		$criteria->compare('usid',$this->usid);
		$criteria->compare('evalid',$this->evalid);
		$criteria->compare('idsid',$this->idsid);
		$criteria->compare('sid',$this->sid);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('submitdate',$this->submitdate,true);
		$criteria->compare('idaEncuestar',$this->idaEncuestar);
		$criteria->compare('tipo',$this->tipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalControl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

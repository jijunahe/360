<?php

/**
 * This is the model class for table "{{ana_monedaunitaria}}".
 *
 * The followings are the available columns in table '{{ana_monedaunitaria}}':
 * @property string $id
 * @property integer $idMoneda
 * @property string $hash
 * @property string $fechacreacion
 * @property string $keyid
 * @property string $asignado
 */
class AnaMonedaunitaria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_monedaunitaria}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idMoneda', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>200),
			array('keyid', 'length', 'max'=>100),
			array('asignado', 'length', 'max'=>1),
			array('fechacreacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idMoneda, hash, fechacreacion, keyid, asignado', 'safe', 'on'=>'search'),
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
			'idMoneda' => 'Id Moneda',
			'hash' => 'Hash',
			'fechacreacion' => 'Fechacreacion',
			'keyid' => 'Keyid',
			'asignado' => 'Asignado',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('idMoneda',$this->idMoneda);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('keyid',$this->keyid,true);
		$criteria->compare('asignado',$this->asignado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaMonedaunitaria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

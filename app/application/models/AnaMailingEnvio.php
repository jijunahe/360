<?php

/**
 * This is the model class for table "{{ana_mailing_envio}}".
 *
 * The followings are the available columns in table '{{ana_mailing_envio}}':
 * @property string $keyidproyecto
 * @property integer $idUsuario
 * @property string $keyidmailing
 * @property string $fechaenvio
 * @property string $participantes
 */
class AnaMailingEnvio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_mailing_envio}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuario', 'numerical', 'integerOnly'=>true),
			array('keyidproyecto, keyidmailing', 'length', 'max'=>100),
			array('fechaenvio, participantes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keyidproyecto, idUsuario, keyidmailing, fechaenvio, participantes', 'safe', 'on'=>'search'),
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
			'keyidproyecto' => 'Keyidproyecto',
			'idUsuario' => 'Id Usuario',
			'keyidmailing' => 'Keyidmailing',
			'fechaenvio' => 'Fechaenvio',
			'participantes' => 'Participantes',
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

		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('keyidmailing',$this->keyidmailing,true);
		$criteria->compare('fechaenvio',$this->fechaenvio,true);
		$criteria->compare('participantes',$this->participantes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaMailingEnvio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

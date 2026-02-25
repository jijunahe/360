<?php

/**
 * This is the model class for table "{{ana_encuesta_respuestas_abiertas}}".
 *
 * The followings are the available columns in table '{{ana_encuesta_respuestas_abiertas}}':
 * @property string $keyid
 * @property string $keyidevaluado
 * @property string $keyidevaluador
 * @property string $keyidproyecto
 * @property string $keyidpregunta
 * @property string $respuesta
 * @property string $fecharegistro
 */
class AnaEncuestaRespuestasAbiertas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_encuesta_respuestas_abiertas}}';
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
			array('keyid, keyidevaluado, keyidevaluador, keyidproyecto, keyidpregunta, respuesta', 'length', 'max'=>100),
			array('fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keyid, keyidevaluado, keyidevaluador, keyidproyecto, keyidpregunta, respuesta, fecharegistro', 'safe', 'on'=>'search'),
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
			'keyidevaluado' => 'Keyidevaluado',
			'keyidevaluador' => 'Keyidevaluador',
			'keyidproyecto' => 'Keyidproyecto',
			'keyidpregunta' => 'Keyidpregunta',
			'respuesta' => 'Respuesta',
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

		$criteria->compare('keyid',$this->keyid,true);
		$criteria->compare('keyidevaluado',$this->keyidevaluado,true);
		$criteria->compare('keyidevaluador',$this->keyidevaluador,true);
		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('keyidpregunta',$this->keyidpregunta,true);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaEncuestaRespuestasAbiertas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

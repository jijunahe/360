<?php

/**
 * This is the model class for table "{{ana_encuesta_participanterelaciones}}".
 *
 * The followings are the available columns in table '{{ana_encuesta_participanterelaciones}}':
 * @property string $keyid
 * @property string $keyidparticipante
 * @property string $keyidparticipanteevaluador
 * @property string $keyidrelacion
 * @property string $keyidproyecto
 * @property string $fecharegistro
 * @property string $estado
 * @property string $jsonrtemp
 * @property string $fecharesuelto
 */
class AnaEncuestaParticipanterelaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_encuesta_participanterelaciones}}';
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
			array('keyid, keyidparticipante, keyidparticipanteevaluador, keyidrelacion, keyidproyecto', 'length', 'max'=>100),
			array('estado', 'length', 'max'=>1),
			array('fecharegistro, jsonrtemp, fecharesuelto', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('keyid, keyidparticipante, keyidparticipanteevaluador, keyidrelacion, keyidproyecto, fecharegistro, estado, jsonrtemp, fecharesuelto', 'safe', 'on'=>'search'),
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
			'keyidparticipante' => 'Keyidparticipante',
			'keyidparticipanteevaluador' => 'Keyidparticipanteevaluador',
			'keyidrelacion' => 'Keyidrelacion',
			'keyidproyecto' => 'Keyidproyecto',
			'fecharegistro' => 'Fecharegistro',
			'estado' => 'Estado',
			'jsonrtemp' => 'Jsonrtemp',
			'fecharesuelto' => 'Fecharesuelto',
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
		$criteria->compare('keyidparticipante',$this->keyidparticipante,true);
		$criteria->compare('keyidparticipanteevaluador',$this->keyidparticipanteevaluador,true);
		$criteria->compare('keyidrelacion',$this->keyidrelacion,true);
		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('jsonrtemp',$this->jsonrtemp,true);
		$criteria->compare('fecharesuelto',$this->fecharesuelto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaEncuestaParticipanterelaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

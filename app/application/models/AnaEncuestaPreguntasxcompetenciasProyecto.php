<?php

/**
 * This is the model class for table "{{ana_encuesta_preguntasxcompetencias_proyecto}}".
 *
 * The followings are the available columns in table '{{ana_encuesta_preguntasxcompetencias_proyecto}}':
 * @property integer $id
 * @property string $keyidpregunta
 * @property string $keyidcompetencia
 * @property string $keyidproyecto
 * @property integer $idUsuario
 * @property string $keyidpreguntaorigen
 * @property integer $idcompetenciaorigen
 */
class AnaEncuestaPreguntasxcompetenciasProyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_encuesta_preguntasxcompetencias_proyecto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuario, idcompetenciaorigen', 'numerical', 'integerOnly'=>true),
			array('keyidpregunta, keyidcompetencia, keyidproyecto, keyidpreguntaorigen', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, keyidpregunta, keyidcompetencia, keyidproyecto, idUsuario, keyidpreguntaorigen, idcompetenciaorigen', 'safe', 'on'=>'search'),
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
			'keyidpregunta' => 'Keyidpregunta',
			'keyidcompetencia' => 'Keyidcompetencia',
			'keyidproyecto' => 'Keyidproyecto',
			'idUsuario' => 'Id Usuario',
			'keyidpreguntaorigen' => 'Keyidpreguntaorigen',
			'idcompetenciaorigen' => 'Idcompetenciaorigen',
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
		$criteria->compare('keyidpregunta',$this->keyidpregunta,true);
		$criteria->compare('keyidcompetencia',$this->keyidcompetencia,true);
		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('keyidpreguntaorigen',$this->keyidpreguntaorigen,true);
		$criteria->compare('idcompetenciaorigen',$this->idcompetenciaorigen);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaEncuestaPreguntasxcompetenciasProyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

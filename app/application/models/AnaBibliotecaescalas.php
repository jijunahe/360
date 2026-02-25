<?php

/**
 * This is the model class for table "{{ana_bibliotecaescalas}}".
 *
 * The followings are the available columns in table '{{ana_bibliotecaescalas}}':
 * @property integer $id
 * @property string $nombre
 * @property string $json
 * @property integer $rango
 * @property string $preguntabase
 * @property string $abreviacion
 */
class AnaBibliotecaescalas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_bibliotecaescalas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rango', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('abreviacion', 'length', 'max'=>10),
			array('json, preguntabase', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, json, rango, preguntabase, abreviacion', 'safe', 'on'=>'search'),
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
			'json' => 'Json',
			'rango' => 'Rango',
			'preguntabase' => 'Preguntabase',
			'abreviacion' => 'Abreviacion',
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
		$criteria->compare('json',$this->json,true);
		$criteria->compare('rango',$this->rango);
		$criteria->compare('preguntabase',$this->preguntabase,true);
		$criteria->compare('abreviacion',$this->abreviacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaBibliotecaescalas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

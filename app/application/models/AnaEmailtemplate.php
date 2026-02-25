<?php

/**
 * This is the model class for table "{{ana_emailtemplate}}".
 *
 * The followings are the available columns in table '{{ana_emailtemplate}}':
 * @property integer $id
 * @property string $nombre
 * @property integer $tipo
 * @property string $fecha
 * @property string $keyidproyecto
 * @property string $html
 * @property string $participantes
 * @property string $asunto
 */
class AnaEmailtemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_emailtemplate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('keyidproyecto', 'length', 'max'=>100),
			array('asunto', 'length', 'max'=>200),
			array('fecha, html, participantes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, tipo, fecha, keyidproyecto, html, participantes, asunto', 'safe', 'on'=>'search'),
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
			'tipo' => 'Tipo',
			'fecha' => 'Fecha',
			'keyidproyecto' => 'Keyidproyecto',
			'html' => 'Html',
			'participantes' => 'Participantes',
			'asunto' => 'Asunto',
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
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('html',$this->html,true);
		$criteria->compare('participantes',$this->participantes,true);
		$criteria->compare('asunto',$this->asunto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaEmailtemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

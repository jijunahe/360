<?php

/**
 * This is the model class for table "{{ushseq}}".
 *
 * The followings are the available columns in table '{{ushseq}}':
 * @property integer $id
 * @property string $estado
 * @property string $nombre
 * @property integer $idorg
 * @property string $token
 * @property string $fechainicio
 * @property string $fechafin
 * @property string $fecharegistro
 */
class Ushseq extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ushseq}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idorg', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>8),
			array('nombre, token', 'length', 'max'=>255),
			array('fechainicio, fechafin, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estado, nombre, idorg, token, fechainicio, fechafin, fecharegistro', 'safe', 'on'=>'search'),
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
			'estado' => 'Estado',
			'nombre' => 'Nombre',
			'idorg' => 'Idorg',
			'token' => 'Token',
			'fechainicio' => 'Fechainicio',
			'fechafin' => 'Fechafin',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('idorg',$this->idorg);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('fechainicio',$this->fechainicio,true);
		$criteria->compare('fechafin',$this->fechafin,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ushseq the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

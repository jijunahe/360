<?php

/**
 * This is the model class for table "{{eval_simulacion}}".
 *
 * The followings are the available columns in table '{{eval_simulacion}}':
 * @property integer $id
 * @property integer $idunidad
 * @property integer $idbateria
 * @property string $nombre
 * @property integer $cantidad
 * @property string $estado
 * @property string $fechacreacion
 */
class EvalSimulacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_simulacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idunidad, idbateria, cantidad', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('estado', 'length', 'max'=>10),
			array('fechacreacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idunidad, idbateria, nombre, cantidad, estado, fechacreacion', 'safe', 'on'=>'search'),
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
			'idunidad' => 'Idunidad',
			'idbateria' => 'Idbateria',
			'nombre' => 'Nombre',
			'cantidad' => 'Cantidad',
			'estado' => 'Estado',
			'fechacreacion' => 'Fechacreacion',
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
		$criteria->compare('idunidad',$this->idunidad);
		$criteria->compare('idbateria',$this->idbateria);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalSimulacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

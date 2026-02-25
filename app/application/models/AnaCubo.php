<?php

/**
 * This is the model class for table "{{ana_cubo}}".
 *
 * The followings are the available columns in table '{{ana_cubo}}':
 * @property integer $id
 * @property string $nombre
 * @property integer $id_origendatos
 * @property string $activo
 * @property string $fecha
 * @property string $fechamodificado
 * @property integer $id_usuario
 */
class AnaCubo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_cubo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_origendatos, id_usuario', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('activo', 'length', 'max'=>1),
			array('fecha, fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, id_origendatos, activo, fecha, fechamodificado, id_usuario', 'safe', 'on'=>'search'),
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
			'id_origendatos' => 'Id Origendatos',
			'activo' => 'Activo',
			'fecha' => 'Fecha',
			'fechamodificado' => 'Fechamodificado',
			'id_usuario' => 'Id Usuario',
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
		$criteria->compare('id_origendatos',$this->id_origendatos);
		$criteria->compare('activo',$this->activo,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('fechamodificado',$this->fechamodificado,true);
		$criteria->compare('id_usuario',$this->id_usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaCubo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "{{eval_archivos}}".
 *
 * The followings are the available columns in table '{{eval_archivos}}':
 * @property integer $id
 * @property string $tipo
 * @property integer $idorg
 * @property string $nombre
 * @property string $descriptcion
 * @property string $fechaini
 * @property string $fechafin
 * @property string $fecha
 * @property string $estado
 */
class EvalArchivos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_archivos}}';
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
			array('tipo, nombre, descriptcion, fecha', 'length', 'max'=>255),
			array('estado', 'length', 'max'=>2),
			array('fechaini, fechafin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo, idorg, nombre, descriptcion, fechaini, fechafin, fecha, estado', 'safe', 'on'=>'search'),
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
			'tipo' => 'Tipo',
			'idorg' => 'Idorg',
			'nombre' => 'Nombre',
			'descriptcion' => 'Descriptcion',
			'fechaini' => 'Fechaini',
			'fechafin' => 'Fechafin',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
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
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('idorg',$this->idorg);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descriptcion',$this->descriptcion,true);
		$criteria->compare('fechaini',$this->fechaini,true);
		$criteria->compare('fechafin',$this->fechafin,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalArchivos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

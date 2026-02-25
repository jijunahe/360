<?php

/**
 * This is the model class for table "{{usuario_programacion}}".
 *
 * The followings are the available columns in table '{{usuario_programacion}}':
 * @property integer $id
 * @property integer $idUsuario
 * @property integer $idProgramacion
 * @property string $descripcion
 * @property string $estado
 * @property integer $idAnswer
 * @property string $fechacreacion
 * @property string $fechaactualizacion
 */
class UsuarioProgramacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{usuario_programacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuario, idProgramacion, idAnswer', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>1),
			array('descripcion, fechacreacion, fechaactualizacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idUsuario, idProgramacion, descripcion, estado, idAnswer, fechacreacion, fechaactualizacion', 'safe', 'on'=>'search'),
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
			'idUsuario' => 'Id Usuario',
			'idProgramacion' => 'Id Programacion',
			'descripcion' => 'Descripcion',
			'estado' => 'Estado',
			'idAnswer' => 'Id Answer',
			'fechacreacion' => 'Fechacreacion',
			'fechaactualizacion' => 'Fechaactualizacion',
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
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('idProgramacion',$this->idProgramacion);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('idAnswer',$this->idAnswer);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioProgramacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

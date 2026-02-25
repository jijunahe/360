<?php

/**
 * This is the model class for table "{{ana_encuesta_competencia}}".
 *
 * The followings are the available columns in table '{{ana_encuesta_competencia}}':
 * @property integer $id
 * @property integer $idEncuesta
 * @property string $nombre_esp
 * @property string $descripcion_esp
 * @property string $estado
 * @property string $fecharegistro
 */
class AnaEncuestaCompetencia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_encuesta_competencia}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEncuesta', 'numerical', 'integerOnly'=>true),
			array('nombre_esp', 'length', 'max'=>200),
			array('estado', 'length', 'max'=>1),
			array('descripcion_esp, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idEncuesta, nombre_esp, descripcion_esp, estado, fecharegistro', 'safe', 'on'=>'search'),
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
			'idEncuesta' => 'Id Encuesta',
			'nombre_esp' => 'Nombre Esp',
			'descripcion_esp' => 'Descripcion Esp',
			'estado' => 'Estado',
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
		$criteria->compare('idEncuesta',$this->idEncuesta);
		$criteria->compare('nombre_esp',$this->nombre_esp,true);
		$criteria->compare('descripcion_esp',$this->descripcion_esp,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaEncuestaCompetencia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

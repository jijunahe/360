<?php

/**
 * This is the model class for table "{{ana_view_encuesta_preguntasxcompetencias_proyecto}}".
 *
 * The followings are the available columns in table '{{ana_view_encuesta_preguntasxcompetencias_proyecto}}':
 * @property integer $id
 * @property string $keyidpregunta
 * @property string $keyidcompetencia
 * @property string $keyidproyecto
 * @property integer $idUsuario
 * @property string $keyidpreguntaorigen
 * @property integer $idcompetenciaorigen
 * @property string $nombrecompetencia
 * @property string $descripcioncompetencia
 * @property string $estadocompetencia
 * @property integer $idorigencompetencia
 * @property string $modificadocompetencia
 * @property string $enunciadopregunta
 * @property string $estadopregunta
 * @property integer $idordenpregunta
 * @property string $keyidorigenpregunta
 * @property string $modificadopregunta
 */
class AnaViewEncuestaPreguntasxcompetenciasProyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_view_encuesta_preguntasxcompetencias_proyecto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idordenpregunta', 'required'),
			array('id, idUsuario, idcompetenciaorigen, idorigencompetencia, idordenpregunta', 'numerical', 'integerOnly'=>true),
			array('keyidpregunta, keyidcompetencia, keyidproyecto, keyidpreguntaorigen, keyidorigenpregunta', 'length', 'max'=>100),
			array('nombrecompetencia', 'length', 'max'=>200),
			array('estadocompetencia, modificadocompetencia, estadopregunta, modificadopregunta', 'length', 'max'=>1),
			array('descripcioncompetencia, enunciadopregunta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, keyidpregunta, keyidcompetencia, keyidproyecto, idUsuario, keyidpreguntaorigen, idcompetenciaorigen, nombrecompetencia, descripcioncompetencia, estadocompetencia, idorigencompetencia, modificadocompetencia, enunciadopregunta, estadopregunta, idordenpregunta, keyidorigenpregunta, modificadopregunta', 'safe', 'on'=>'search'),
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
			'nombrecompetencia' => 'Nombrecompetencia',
			'descripcioncompetencia' => 'Descripcioncompetencia',
			'estadocompetencia' => 'Estadocompetencia',
			'idorigencompetencia' => 'Idorigencompetencia',
			'modificadocompetencia' => 'Modificadocompetencia',
			'enunciadopregunta' => 'Enunciadopregunta',
			'estadopregunta' => 'Estadopregunta',
			'idordenpregunta' => 'Idordenpregunta',
			'keyidorigenpregunta' => 'Keyidorigenpregunta',
			'modificadopregunta' => 'Modificadopregunta',
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
		$criteria->compare('nombrecompetencia',$this->nombrecompetencia,true);
		$criteria->compare('descripcioncompetencia',$this->descripcioncompetencia,true);
		$criteria->compare('estadocompetencia',$this->estadocompetencia,true);
		$criteria->compare('idorigencompetencia',$this->idorigencompetencia);
		$criteria->compare('modificadocompetencia',$this->modificadocompetencia,true);
		$criteria->compare('enunciadopregunta',$this->enunciadopregunta,true);
		$criteria->compare('estadopregunta',$this->estadopregunta,true);
		$criteria->compare('idordenpregunta',$this->idordenpregunta);
		$criteria->compare('keyidorigenpregunta',$this->keyidorigenpregunta,true);
		$criteria->compare('modificadopregunta',$this->modificadopregunta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaViewEncuestaPreguntasxcompetenciasProyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

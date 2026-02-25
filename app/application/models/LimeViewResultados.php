<?php

/**
 * This is the model class for table "{{view_resultados}}".
 *
 * The followings are the available columns in table '{{view_resultados}}':
 * @property string $evaluadoapellido
 * @property string $evaluadonombre
 * @property string $evaluadorapellido
 * @property string $evaluadornombre
 * @property string $keyidrelacion_a
 * @property string $keyidevaluado
 * @property string $keyidevaluador
 * @property string $keyidrelacion
 * @property string $estado
 * @property string $jsonrtemp
 * @property string $fecharesuelto
 * @property string $keyidrespuesta
 * @property string $keyidproyecto
 * @property string $keyidcompetencia
 * @property string $keyidpregunta
 * @property string $respuesta
 * @property string $comentarios
 * @property string $fecharegistro
 * @property string $enunciadopregunta
 * @property string $nombrecompetencia
 * @property string $descripcioncompetencia
 * @property string $codigo_preguntaorigen
 * @property integer $codigo_competenciaorigen
 */
class LimeViewResultados extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{view_resultados}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyidrespuesta', 'required'),
			array('codigo_competenciaorigen', 'numerical', 'integerOnly'=>true),
			array('evaluadoapellido, evaluadonombre, evaluadorapellido, evaluadornombre, keyidrelacion_a, keyidevaluado, keyidevaluador, keyidrelacion, keyidrespuesta, keyidproyecto, keyidcompetencia, keyidpregunta, respuesta, codigo_preguntaorigen', 'length', 'max'=>100),
			array('estado', 'length', 'max'=>1),
			array('nombrecompetencia', 'length', 'max'=>200),
			array('jsonrtemp, fecharesuelto, comentarios, fecharegistro, enunciadopregunta, descripcioncompetencia', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('evaluadoapellido, evaluadonombre, evaluadorapellido, evaluadornombre, keyidrelacion_a, keyidevaluado, keyidevaluador, keyidrelacion, estado, jsonrtemp, fecharesuelto, keyidrespuesta, keyidproyecto, keyidcompetencia, keyidpregunta, respuesta, comentarios, fecharegistro, enunciadopregunta, nombrecompetencia, descripcioncompetencia, codigo_preguntaorigen, codigo_competenciaorigen', 'safe', 'on'=>'search'),
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
			'evaluadoapellido' => 'Evaluadoapellido',
			'evaluadonombre' => 'Evaluadonombre',
			'evaluadorapellido' => 'Evaluadorapellido',
			'evaluadornombre' => 'Evaluadornombre',
			'keyidrelacion_a' => 'Keyidrelacion A',
			'keyidevaluado' => 'Keyidevaluado',
			'keyidevaluador' => 'Keyidevaluador',
			'keyidrelacion' => 'Keyidrelacion',
			'estado' => 'Estado',
			'jsonrtemp' => 'Jsonrtemp',
			'fecharesuelto' => 'Fecharesuelto',
			'keyidrespuesta' => 'Keyidrespuesta',
			'keyidproyecto' => 'Keyidproyecto',
			'keyidcompetencia' => 'Keyidcompetencia',
			'keyidpregunta' => 'Keyidpregunta',
			'respuesta' => 'Respuesta',
			'comentarios' => 'Comentarios',
			'fecharegistro' => 'Fecharegistro',
			'enunciadopregunta' => 'Enunciadopregunta',
			'nombrecompetencia' => 'Nombrecompetencia',
			'descripcioncompetencia' => 'Descripcioncompetencia',
			'codigo_preguntaorigen' => 'Codigo Preguntaorigen',
			'codigo_competenciaorigen' => 'Codigo Competenciaorigen',
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

		$criteria->compare('evaluadoapellido',$this->evaluadoapellido,true);
		$criteria->compare('evaluadonombre',$this->evaluadonombre,true);
		$criteria->compare('evaluadorapellido',$this->evaluadorapellido,true);
		$criteria->compare('evaluadornombre',$this->evaluadornombre,true);
		$criteria->compare('keyidrelacion_a',$this->keyidrelacion_a,true);
		$criteria->compare('keyidevaluado',$this->keyidevaluado,true);
		$criteria->compare('keyidevaluador',$this->keyidevaluador,true);
		$criteria->compare('keyidrelacion',$this->keyidrelacion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('jsonrtemp',$this->jsonrtemp,true);
		$criteria->compare('fecharesuelto',$this->fecharesuelto,true);
		$criteria->compare('keyidrespuesta',$this->keyidrespuesta,true);
		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('keyidcompetencia',$this->keyidcompetencia,true);
		$criteria->compare('keyidpregunta',$this->keyidpregunta,true);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('comentarios',$this->comentarios,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('enunciadopregunta',$this->enunciadopregunta,true);
		$criteria->compare('nombrecompetencia',$this->nombrecompetencia,true);
		$criteria->compare('descripcioncompetencia',$this->descripcioncompetencia,true);
		$criteria->compare('codigo_preguntaorigen',$this->codigo_preguntaorigen,true);
		$criteria->compare('codigo_competenciaorigen',$this->codigo_competenciaorigen);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LimeViewResultados the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

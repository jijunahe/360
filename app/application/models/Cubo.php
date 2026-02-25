<?php

/**
 * This is the model class for table "{{cubo}}".
 *
 * The followings are the available columns in table '{{cubo}}':
 * @property integer $id
 * @property integer $idEncuesta
 * @property integer $anw_id
 * @property string $anw_submitdate
 * @property integer $anw_lastpage
 * @property string $anw_startlanguage
 * @property string $anw_ipaddr
 * @property integer $anw_refurl
 * @property string $respuesta
 * @property string $codigopregunta
 * @property integer $qid
 * @property integer $idPreg
 * @property string $nombregrupo
 * @property string $pregunta
 * @property string $codigoRespuesta
 * @property string $nombreEncuesta
 * @property integer $valorEscala
 */
class Cubo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cubo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEncuesta, anw_id, anw_lastpage, anw_refurl, qid, idPreg, valorEscala', 'numerical', 'integerOnly'=>true),
			array('anw_startlanguage', 'length', 'max'=>20),
			array('anw_ipaddr', 'length', 'max'=>50),
			array('respuesta, nombregrupo, pregunta, nombreEncuesta', 'length', 'max'=>500),
			array('codigopregunta, codigoRespuesta', 'length', 'max'=>100),
			array('anw_submitdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idEncuesta, anw_id, anw_submitdate, anw_lastpage, anw_startlanguage, anw_ipaddr, anw_refurl, respuesta, codigopregunta, qid, idPreg, nombregrupo, pregunta, codigoRespuesta, nombreEncuesta, valorEscala', 'safe', 'on'=>'search'),
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
			'anw_id' => 'Anw',
			'anw_submitdate' => 'Anw Submitdate',
			'anw_lastpage' => 'Anw Lastpage',
			'anw_startlanguage' => 'Anw Startlanguage',
			'anw_ipaddr' => 'Anw Ipaddr',
			'anw_refurl' => 'Anw Refurl',
			'respuesta' => 'Respuesta',
			'codigopregunta' => 'Codigopregunta',
			'qid' => 'Qid',
			'idPreg' => 'Id Preg',
			'nombregrupo' => 'Nombregrupo',
			'pregunta' => 'Pregunta',
			'codigoRespuesta' => 'Codigo Respuesta',
			'nombreEncuesta' => 'Nombre Encuesta',
			'valorEscala' => 'Valor Escala',
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
		$criteria->compare('anw_id',$this->anw_id);
		$criteria->compare('anw_submitdate',$this->anw_submitdate,true);
		$criteria->compare('anw_lastpage',$this->anw_lastpage);
		$criteria->compare('anw_startlanguage',$this->anw_startlanguage,true);
		$criteria->compare('anw_ipaddr',$this->anw_ipaddr,true);
		$criteria->compare('anw_refurl',$this->anw_refurl);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('codigopregunta',$this->codigopregunta,true);
		$criteria->compare('qid',$this->qid);
		$criteria->compare('idPreg',$this->idPreg);
		$criteria->compare('nombregrupo',$this->nombregrupo,true);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('codigoRespuesta',$this->codigoRespuesta,true);
		$criteria->compare('nombreEncuesta',$this->nombreEncuesta,true);
		$criteria->compare('valorEscala',$this->valorEscala);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cubo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

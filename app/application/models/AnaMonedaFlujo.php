<?php

/**
 * This is the model class for table "{{ana_moneda_flujo}}".
 *
 * The followings are the available columns in table '{{ana_moneda_flujo}}':
 * @property string $id
 * @property integer $idUsuarioOrigen
 * @property integer $idUsuarioDestino
 * @property integer $idMoneda
 * @property integer $creditos
 * @property string $hash
 * @property string $evento
 * @property string $fecharegistro
 * @property string $monedas
 * @property string $keyidproyecto
 * @property string $evaluado
 */
class AnaMonedaFlujo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_moneda_flujo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuarioOrigen, idUsuarioDestino, idMoneda, creditos', 'numerical', 'integerOnly'=>true),
			array('hash, evento', 'length', 'max'=>200),
			array('keyidproyecto, evaluado', 'length', 'max'=>150),
			array('fecharegistro, monedas', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idUsuarioOrigen, idUsuarioDestino, idMoneda, creditos, hash, evento, fecharegistro, monedas, keyidproyecto, evaluado', 'safe', 'on'=>'search'),
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
			'idUsuarioOrigen' => 'Id Usuario Origen',
			'idUsuarioDestino' => 'Id Usuario Destino',
			'idMoneda' => 'Id Moneda',
			'creditos' => 'Creditos',
			'hash' => 'Hash',
			'evento' => 'Evento',
			'fecharegistro' => 'Fecharegistro',
			'monedas' => 'Monedas',
			'keyidproyecto' => 'Keyidproyecto',
			'evaluado' => 'Evaluado',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('idUsuarioOrigen',$this->idUsuarioOrigen);
		$criteria->compare('idUsuarioDestino',$this->idUsuarioDestino);
		$criteria->compare('idMoneda',$this->idMoneda);
		$criteria->compare('creditos',$this->creditos);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('evento',$this->evento,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('monedas',$this->monedas,true);
		$criteria->compare('keyidproyecto',$this->keyidproyecto,true);
		$criteria->compare('evaluado',$this->evaluado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaMonedaFlujo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

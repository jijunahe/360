<?php

/**
 * This is the model class for table "{{ana_moneda}}".
 *
 * The followings are the available columns in table '{{ana_moneda}}':
 * @property string $id
 * @property double $valor
 * @property double $conversion
 * @property string $nombre
 * @property string $cantidad
 * @property string $hash
 * @property string $fechacreacion
 * @property string $fecharegistro
 */
class AnaMoneda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_moneda}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valor, conversion', 'numerical'),
			array('nombre', 'length', 'max'=>200),
			array('cantidad', 'length', 'max'=>11),
			array('hash, fechacreacion, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, valor, conversion, nombre, cantidad, hash, fechacreacion, fecharegistro', 'safe', 'on'=>'search'),
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
			'valor' => 'Valor',
			'conversion' => 'Conversion',
			'nombre' => 'Nombre',
			'cantidad' => 'Cantidad',
			'hash' => 'Hash',
			'fechacreacion' => 'Fechacreacion',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('conversion',$this->conversion);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaMoneda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
